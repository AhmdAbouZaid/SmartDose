<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
     */
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $payments = Payment::with('order.user')
                ->latest()
                ->paginate(20);
        } else {

            $payments = Payment::whereHas('order', function ($query) {
                $query->where('user_id', auth()->id());
            })
                ->with('order')
                ->latest()
                ->paginate(20);
        }

        return view('payments.index', compact('payments'));
    }

    /**
     * Store a newly created payment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_method' => 'required|string|in:paypal,stripe,card,cod,cash_on_delivery',
        ]);

        $order = Order::findOrFail($validated['order_id']);

        // Make sure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if order already has a successful payment
        if ($order->payment && $order->payment->isSuccessful()) {
            return back()->with('error', 'Order already paid.');
        }

        DB::beginTransaction();

        try {
            // For Cash on Delivery, mark as success immediately
            if ($validated['payment_method'] === 'cod' || $validated['payment_method'] === 'cash_on_delivery') {
                $payment = Payment::create([
                    'order_id' => $order->id,
                    'amount' => $order->total,
                    'status' => 'success',
                    'payment_method' => 'cod',
                    'payment_gateway' => 'cash_on_delivery',
                    'transaction_id' => 'COD-' . $order->id . '-' . time(),
                ]);

                // Mark order as completed
                $order->markAsCompleted();

                DB::commit();

                return redirect()
                    ->route('orders.show', $order)
                    ->with('success', 'Order confirmed! Pay cash when you receive your delivery.');
            }

            // For other payment methods (PayPal, Stripe, etc.)
            $payment = Payment::create([
                'order_id' => $order->id,
                'amount' => $order->total,
                'status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'payment_gateway' => $validated['payment_method'],
            ]);

            DB::commit();

            // Redirect to payment gateway (to be implemented)
            return redirect()
                ->route('payments.show', $payment)
                ->with('success', 'Payment initiated. Please complete the payment.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to process payment: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified payment.
     */
    public function show(Payment $payment)
    {
        // Make sure user owns this payment
        if ($payment->order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $payment->load('order.items.product');

        return view('payments.show', compact('payment'));
    }

    /**
     * Handle payment callback from gateway.
     */
    public function callback(Request $request)
    {
        $paymentId = $request->input('payment_id');
        $transactionId = $request->input('transaction_id');
        $status = $request->input('status', 'success');

        if (!$paymentId) {
            return redirect()
                ->route('orders.index')
                ->with('error', 'Invalid payment callback.');
        }

        $payment = Payment::findOrFail($paymentId);

        DB::beginTransaction();

        try {
            if ($status === 'success') {
                $payment->markAsSuccess($transactionId);
                $payment->order->markAsCompleted();

                DB::commit();

                return redirect()
                    ->route('orders.show', $payment->order)
                    ->with('success', 'Payment completed successfully!');
            } else {
                $payment->markAsFailed();

                DB::commit();

                return redirect()
                    ->route('orders.show', $payment->order)
                    ->with('error', 'Payment failed. Please try again.');
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('orders.index')
                ->with('error', 'Payment processing failed.');
        }
    }

    /**
     * Process refund for a payment.
     */
    public function refund(Payment $payment)
    {
        // Make sure user owns this payment or is admin
        if ($payment->order->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Only successful payments can be refunded (not COD)
        if (!$payment->isSuccessful() || $payment->isCashOnDelivery()) {
            return back()->with('error', 'This payment cannot be refunded.');
        }

        DB::beginTransaction();

        try {
            $payment->markAsRefunded();
            $payment->order->markAsCancelled();

            // Return stock
            foreach ($payment->order->items as $item) {
                $product = $item->product;
                if ($product) {
                    $product->increaseStock($item->quantity);
                }
            }

            DB::commit();

            return redirect()
                ->route('orders.show', $payment->order)
                ->with('success', 'Payment refunded successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to process refund.');
        }
    }
}

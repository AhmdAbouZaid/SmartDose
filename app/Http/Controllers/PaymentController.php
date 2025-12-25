<?php
/**
 * @mixin \Illuminate\Http\Request
 */
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Store a newly created payment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_method' => 'required|string|in:paypal,stripe,card',
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
            // Create payment record
            $payment = Payment::create([
                'order_id' => $order->id,
                'amount' => $order->total,
                'status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'payment_gateway' => $validated['payment_method'],
            ]);

            DB::commit();

            // Redirect to payment gateway
            // This will be implemented when we integrate PayPal/Stripe
            return redirect()->route('payments.show', $payment)
                ->with('success', 'Payment initiated. Please complete the payment.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->with('error', 'Failed to initiate payment.');
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
        // This will be implemented when we integrate PayPal/Stripe
        // For now, we'll just simulate a successful payment
        
        $paymentId = $request->input('payment_id');
        $transactionId = $request->input('transaction_id');
        $status = $request->input('status', 'success');

        if (!$paymentId) {
            return redirect()->route('orders.index')
                ->with('error', 'Invalid payment callback.');
        }

        $payment = Payment::findOrFail($paymentId);

        DB::beginTransaction();
        
        try {
            if ($status === 'success') {
                // Mark payment as successful
                $payment->markAsSuccess($transactionId);
                
                // Mark order as completed
                $payment->order->markAsCompleted();
                
                DB::commit();
                
                return redirect()->route('orders.show', $payment->order)
                    ->with('success', 'Payment completed successfully!');
            } else {
                // Mark payment as failed
                $payment->markAsFailed();
                
                DB::commit();
                
                return redirect()->route('orders.show', $payment->order)
                    ->with('error', 'Payment failed. Please try again.');
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->route('orders.index')
                ->with('error', 'Payment processing failed.');
        }
    }

    /**
     * Process refund for a payment.
     */
    public function refund(Payment $payment)
    {
        // Make sure user owns this payment
        if ($payment->order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Only successful payments can be refunded
        if (!$payment->isSuccessful()) {
            return back()->with('error', 'Only successful payments can be refunded.');
        }

        DB::beginTransaction();
        
        try {
            // Mark payment as refunded
            $payment->markAsRefunded();
            
            // Cancel the order
            $payment->order->markAsCancelled();
            
            // Return stock
            foreach ($payment->order->items as $item) {
                $product = $item->product;
                $product->increaseStock($item->quantity);
            }

            DB::commit();

            return redirect()->route('orders.show', $payment->order)
                ->with('success', 'Payment refunded successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->with('error', 'Failed to process refund.');
        }
    }
}
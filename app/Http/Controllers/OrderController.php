<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display user's orders.
     */
    public function index()
    {
        $orders = auth()->user()
            ->orders()
            ->with('items.product')
            ->latest()
            ->paginate(10);
        
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        
        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created order.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        
        try {
            $total = 0;
            $orderItems = [];

            // Calculate total and validate stock
            foreach ($validated['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Product '{$product->name}' is out of stock.");
                }

                $itemTotal = $product->price * $item['quantity'];
                $total += $itemTotal;

                $orderItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ];
            }

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'status' => 'pending',
            ]);

            // Create order items and decrease stock
            foreach ($orderItems as $item) {
                $order->items()->create($item);
                
                $product = Product::find($item['product_id']);
                $product->decreaseStock($item['quantity']);
            }

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Order created successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Make sure user can only see their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $order->load('items.product', 'payment');
        
        return view('orders.show', compact('order'));
    }

    /**
     * Cancel the order.
     */
    public function cancel(Order $order)
    {
        // Make sure user can only cancel their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Only pending orders can be cancelled
        if (!$order->isPending()) {
            return back()->with('error', 'Only pending orders can be cancelled.');
        }

        DB::beginTransaction();
        
        try {
            // Return stock
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                $product->increaseStock($item->quantity);
            }

            // Cancel order
            $order->markAsCancelled();

            DB::commit();

            return redirect()->route('orders.index')
                ->with('success', 'Order cancelled successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->with('error', 'Failed to cancel order.');
        }
    }

    /**
     * Confirm delivery by user.
     */
    public function confirmDelivery(Order $order)
    {
        // Make sure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Only completed orders can be confirmed
        if (!$order->isCompleted()) {
            return back()->with('error', 'Only completed orders can be confirmed.');
        }

        // Check if already confirmed
        if ($order->isDelivered()) {
            return back()->with('error', 'Order already confirmed as delivered.');
        }

        // Mark as delivered
        $order->markAsDelivered();

        return redirect()->route('orders.index')
            ->with('success', 'Thank you for confirming delivery!');
    }
}
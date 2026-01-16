<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('orders.show', $payment->order) }}" 
               class="text-gray-600 hover:text-gray-900 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    @if(Auth::user()->isAdmin())
                        Payment Details
                    @else
                        Payment Confirmation
                    @endif
                </h2>
                <p class="text-sm text-gray-600">
                    @if(Auth::user()->isAdmin())
                        Payment for Order #{{ $payment->order->id }}
                    @else
                        Order placed successfully
                    @endif
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Payment Status Card -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6 {{ $payment->isSuccessful() ? 'bg-gradient-to-r from-green-500 to-emerald-400' : ($payment->isPending() ? 'bg-gradient-to-r from-yellow-500 to-orange-400' : 'bg-gradient-to-r from-red-500 to-rose-400') }} text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold">Payment Status</h3>
                                <p class="text-sm opacity-90">Current payment status</p>
                            </div>
                            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                @if($payment->isSuccessful())
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                @elseif($payment->isPending())
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @else
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                @endif
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="text-3xl font-bold">
                                @if($payment->isSuccessful())
                                    Payment Successful
                                @elseif($payment->isPending())
                                    Payment Pending
                                @elseif($payment->status === 'refunded')
                                    Payment Refunded
                                @else
                                    Payment Failed
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="p-6 space-y-4">
                        <div>
                            <p class="text-sm text-gray-600">Amount</p>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($payment->amount, 2) }} EGP</p>
                        </div>

                        @if(Auth::user()->isAdmin() && $payment->transaction_id)
                            <div>
                                <p class="text-sm text-gray-600">Transaction ID</p>
                                <p class="font-mono text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded">
                                    {{ $payment->transaction_id }}
                                </p>
                            </div>
                        @endif

                        <div>
                            <p class="text-sm text-gray-600">Payment Method</p>
                            <p class="font-semibold text-gray-900">
                                @if($payment->payment_method === 'cod' || $payment->payment_method === 'cash_on_delivery')
                                    Cash on Delivery
                                @else
                                    {{ ucfirst($payment->payment_method ?? 'N/A') }}
                                @endif
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">
                                @if(Auth::user()->isAdmin())
                                    Payment Gateway
                                @else
                                    Payment Info
                                @endif
                            </p>
                            <p class="font-semibold text-gray-900">
                                @if($payment->payment_method === 'cod' || $payment->payment_method === 'cash_on_delivery')
                                    @if(Auth::user()->isAdmin())
                                        cash_on_delivery
                                    @else
                                        Pay when you receive your order
                                    @endif
                                @else
                                    {{ ucfirst($payment->payment_gateway ?? 'N/A') }}
                                @endif
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Payment Date</p>
                            <p class="font-semibold text-gray-900">
                                {{ $payment->created_at->format('M d, Y \a\t h:i A') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Order Information -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Order Information</h3>
                    </div>

                    <div class="p-6 space-y-4">
                        @if(Auth::user()->isAdmin())
                            <div>
                                <p class="text-sm text-gray-600">Order ID</p>
                                <p class="font-semibold text-gray-900">#{{ $payment->order->id }}</p>
                            </div>
                        @endif

                        <div>
                            <p class="text-sm text-gray-600">Order Status</p>
                            @if($payment->order->isPending())
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @elseif($payment->order->isCompleted())
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                    Completed
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                    Cancelled
                                </span>
                            @endif
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Order Date</p>
                            <p class="font-semibold text-gray-900">
                                {{ $payment->order->created_at->format('M d, Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Total Items</p>
                            <p class="font-semibold text-gray-900">
                                {{ $payment->order->items->count() }} item(s)
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Customer</p>
                            <p class="font-semibold text-gray-900">{{ $payment->order->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $payment->order->user->email }}</p>
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <a href="{{ route('orders.show', $payment->order) }}" 
                               class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
                                View Full Order
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Actions -->
            @if($payment->isPending())
                <div class="mt-6 bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Complete Payment</h3>
                        <p class="text-gray-600 mb-4">Your payment is pending. Please complete the payment to proceed with your order.</p>
                        
                        <div class="flex space-x-4">
                            <button class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-400 text-white rounded-lg font-medium hover:shadow-lg transition">
                                Pay with PayPal
                            </button>
                            <button class="flex-1 px-6 py-3 bg-gray-800 text-white rounded-lg font-medium hover:bg-gray-900 transition">
                                Pay with Card
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            @if($payment->isSuccessful() && Auth::user()->isAdmin())
                <div class="mt-6 bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Admin Actions</h3>
                        
                        <form action="{{ route('payments.refund', $payment) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to refund this payment? This action cannot be undone.');">
                            @csrf
                            <button type="submit" 
                                    class="px-6 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition">
                                Process Refund
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            @if($payment->response_data)
                <div class="mt-6 bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Gateway Response</h3>
                        <pre class="bg-gray-50 p-4 rounded text-xs overflow-auto">{{ json_encode($payment->response_data, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
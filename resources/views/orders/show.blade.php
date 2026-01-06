<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('orders.index') }}" 
                   class="text-gray-600 hover:text-gray-900 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Order #{{ $order->id }}
                    </h2>
                    <p class="text-sm text-gray-600">
                        Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                    </p>
                </div>
            </div>

            @can('cancel', $order)
                @if($order->isPending())
                    <form action="{{ route('orders.cancel', $order) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to cancel this order?');">
                        @csrf
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition">
                            Cancel Order
                        </button>
                    </form>
                @endif
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Order Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Order Status Card -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 bg-gradient-to-r from-blue-600 to-cyan-400 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold">Order Status</h3>
                                    <p class="text-sm opacity-90">Current status of your order</p>
                                </div>
                                @if($order->status === 'pending')
                                    <span class="px-4 py-2 bg-yellow-500 text-white rounded-full font-semibold text-sm">
                                        Pending
                                    </span>
                                @elseif($order->status === 'completed')
                                    <span class="px-4 py-2 bg-green-500 text-white rounded-full font-semibold text-sm">
                                        Completed
                                    </span>
                                @elseif($order->status === 'cancelled')
                                    <span class="px-4 py-2 bg-red-500 text-white rounded-full font-semibold text-sm">
                                        Cancelled
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex-1 text-center">
                                    <div class="w-12 h-12 mx-auto mb-2 rounded-full {{ $order->status !== 'cancelled' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400' }} flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <p class="font-medium">Order Placed</p>
                                </div>
                                <div class="flex-1 border-t-2 {{ $order->status === 'completed' ? 'border-green-500' : 'border-gray-300' }} -mt-6"></div>
                                <div class="flex-1 text-center">
                                    <div class="w-12 h-12 mx-auto mb-2 rounded-full {{ $order->status === 'completed' ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400' }} flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <p class="font-medium">{{ $order->status === 'cancelled' ? 'Cancelled' : 'Completed' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Order Items</h3>
                        </div>

                        <div class="divide-y divide-gray-200">
                            @foreach($order->items as $item)
                                <div class="p-6 flex items-center space-x-4">
                                    <div class="flex-shrink-0 w-20 h-20 bg-gray-100 rounded-lg overflow-hidden">
                                        @if($item->product && $item->product->hasImage())
                                            <img src="{{ $item->product->image_url }}" 
                                                 alt="{{ $item->product->name }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-50 to-cyan-50">
                                                <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900">
                                            {{ $item->product ? $item->product->name : 'Product N/A' }}
                                        </h4>
                                        <p class="text-sm text-gray-600 mt-1">
                                            Quantity: {{ $item->quantity }} × {{ number_format($item->price, 2) }} EGP
                                        </p>
                                    </div>

                                    <div class="text-right">
                                        <p class="font-bold text-gray-900">
                                            {{ number_format($item->price * $item->quantity, 2) }} EGP
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="space-y-6">
                    <!-- Summary Card -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Order Summary</h3>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Items ({{ $order->items->count() }})</span>
                                <span class="font-semibold text-gray-900">{{ number_format($order->total, 2) }} EGP</span>
                            </div>

                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-semibold text-green-600">Free</span>
                            </div>

                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between">
                                    <span class="text-lg font-bold text-gray-900">Total</span>
                                    <span class="text-2xl font-bold text-blue-600">{{ number_format($order->total, 2) }} EGP</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="p-6 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Customer Information</h3>
                        </div>

                        <div class="p-6 space-y-3">
                            <div>
                                <p class="text-sm text-gray-600">Name</p>
                                <p class="font-semibold text-gray-900">{{ $order->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="font-semibold text-gray-900">{{ $order->user->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Order Date</p>
                                <p class="font-semibold text-gray-900">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Section -->
                    @if($order->payment)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            <div class="p-6 bg-gray-50 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900">Payment Details</h3>
                            </div>

                            <div class="p-6 space-y-3">
                                <div>
                                    <p class="text-sm text-gray-600">Payment Status</p>
                                    @if($order->payment->isSuccessful())
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Paid
                                        </span>
                                    @elseif($order->payment->isPending())
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                            Failed
                                        </span>
                                    @endif
                                </div>

                                @if($order->payment->transaction_id)
                                    <div>
                                        <p class="text-sm text-gray-600">Transaction ID</p>
                                        <p class="font-mono text-sm text-gray-900">{{ $order->payment->transaction_id }}</p>
                                    </div>
                                @endif

                                <a href="{{ route('payments.show', $order->payment) }}" 
                                   class="block w-full text-center px-4 py-2 bg-blue-50 text-blue-600 rounded-lg font-medium hover:bg-blue-100 transition">
                                    View Payment Details
                                </a>
                            </div>
                        </div>
                    @else
                        @if($order->isPending())
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <form action="{{ route('payments.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <input type="hidden" name="payment_method" value="paypal">
                                        
                                        <button type="submit" 
                                                class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-400 text-white rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                                            Proceed to Payment
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
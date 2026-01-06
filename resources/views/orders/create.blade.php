<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('orders.index') }}" 
               class="text-gray-600 hover:text-gray-900 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Order
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if($products->isEmpty())
                <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Products Available</h3>
                    <p class="text-gray-600">Please check back later when products are in stock.</p>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-blue-600 to-cyan-400 text-white">
                        <h3 class="text-lg font-semibold">Select Products</h3>
                        <p class="text-sm opacity-90">Choose products and quantities for your order</p>
                    </div>

                    <form action="{{ route('orders.store') }}" method="POST" class="p-6" id="orderForm">
                        @csrf

                        <div class="space-y-4 mb-6" id="productsList">
                            @foreach($products as $index => $product)
                                <div class="border border-gray-200 rounded-lg p-4 product-item" data-price="{{ $product->price }}" data-stock="{{ $product->stock }}">
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0 w-20 h-20 bg-gray-100 rounded-lg overflow-hidden">
                                            @if($product->hasImage())
                                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-50 to-cyan-50">
                                                    <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex-1">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h4 class="font-semibold text-gray-900">{{ $product->name }}</h4>
                                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($product->description, 80) }}</p>
                                                    <div class="mt-2 flex items-center space-x-4">
                                                        <span class="text-lg font-bold text-blue-600">
                                                            {{ number_format($product->price, 2) }} EGP
                                                        </span>
                                                        <span class="text-sm text-gray-500">
                                                            Stock: {{ $product->stock }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="flex items-center space-x-2">
                                                    <input type="checkbox" 
                                                           name="items[{{ $index }}][product_id]" 
                                                           value="{{ $product->id }}"
                                                           id="product_{{ $product->id }}"
                                                           class="product-checkbox w-5 h-5 text-blue-600 rounded focus:ring-blue-500"
                                                           onchange="toggleQuantity({{ $product->id }})">
                                                    <label for="product_{{ $product->id }}" class="text-sm text-gray-700">Select</label>
                                                </div>
                                            </div>

                                            <div class="mt-3 hidden" id="quantity_{{ $product->id }}">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                                <input type="number" 
                                                       name="items[{{ $index }}][quantity]" 
                                                       min="1" 
                                                       max="{{ $product->stock }}"
                                                       value="1"
                                                       class="quantity-input w-24 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                                       onchange="calculateTotal()">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Order Summary -->
                        <div class="border-t border-gray-200 pt-6">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-gray-600">Selected Items:</span>
                                    <span class="font-semibold" id="itemCount">0</span>
                                </div>
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-gray-600">Total Quantity:</span>
                                    <span class="font-semibold" id="totalQuantity">0</span>
                                </div>
                                <div class="flex justify-between items-center text-lg border-t border-gray-200 pt-4">
                                    <span class="font-bold text-gray-900">Order Total:</span>
                                    <span class="font-bold text-blue-600 text-2xl" id="orderTotal">0.00 EGP</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end space-x-4">
                            <a href="{{ route('orders.index') }}" 
                               class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition">
                                Cancel
                            </a>
                            <button type="submit" 
                                    id="submitBtn"
                                    class="px-6 py-2 bg-gradient-to-r from-blue-600 to-cyan-400 text-white rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                                    disabled>
                                Place Order
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <script>
        function toggleQuantity(productId) {
            const checkbox = document.getElementById(`product_${productId}`);
            const quantityDiv = document.getElementById(`quantity_${productId}`);
            
            if (checkbox.checked) {
                quantityDiv.classList.remove('hidden');
            } else {
                quantityDiv.classList.add('hidden');
            }
            
            calculateTotal();
        }

        function calculateTotal() {
            let total = 0;
            let itemCount = 0;
            let totalQuantity = 0;
            
            document.querySelectorAll('.product-checkbox:checked').forEach(checkbox => {
                const productItem = checkbox.closest('.product-item');
                const price = parseFloat(productItem.dataset.price);
                const quantityInput = productItem.querySelector('.quantity-input');
                const quantity = parseInt(quantityInput.value) || 0;
                
                total += price * quantity;
                itemCount++;
                totalQuantity += quantity;
            });
            
            document.getElementById('itemCount').textContent = itemCount;
            document.getElementById('totalQuantity').textContent = totalQuantity;
            document.getElementById('orderTotal').textContent = total.toFixed(2) + ' EGP';
            
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = itemCount === 0;
        }
    </script>
</x-app-layout>
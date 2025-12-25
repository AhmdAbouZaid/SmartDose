<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('products.index') }}" 
               class="text-gray-600 hover:text-gray-900 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product Details
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Product Image -->
                        <div>
                            <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                                @if($product->hasImage())
                                    <img src="{{ $product->image_url }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-50 to-cyan-50">
                                        <svg class="w-32 h-32 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                                {{ $product->name }}
                            </h1>

                            <div class="flex items-center space-x-4 mb-6">
                                <span class="text-4xl font-bold text-blue-600">
                                    {{ number_format($product->price, 2) }} EGP
                                </span>
                                
                                @if($product->inStock())
                                    <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full font-medium">
                                        {{ $product->stock }} in stock
                                    </span>
                                @else
                                    <span class="px-4 py-2 bg-red-100 text-red-700 rounded-full font-medium">
                                        Out of stock
                                    </span>
                                @endif
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ $product->description ?? 'No description available.' }}
                                </p>
                            </div>

                            <!-- Product Info Grid -->
                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Product ID</p>
                                        <p class="font-semibold text-gray-900">#{{ $product->id }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Stock Status</p>
                                        <p class="font-semibold text-gray-900">
                                            {{ $product->inStock() ? 'Available' : 'Out of Stock' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Added</p>
                                        <p class="font-semibold text-gray-900">
                                            {{ $product->created_at->format('M d, Y') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Last Updated</p>
                                        <p class="font-semibold text-gray-900">
                                            {{ $product->updated_at->format('M d, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3">
                                @if($product->inStock())
                                    <a href="{{ route('orders.create') }}" 
                                       class="flex-1 text-center px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-400 text-white rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                                        Order Now
                                    </a>
                                @endif
                                
                                @auth
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('products.edit', $product) }}" 
                                           class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition">
                                            Edit Product
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
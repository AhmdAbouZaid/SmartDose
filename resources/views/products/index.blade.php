<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
            @can('create', App\Models\Product::class)
                <a href="{{ route('products.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-cyan-400 text-white rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Product
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Error Message --}}
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
                    <p class="text-gray-600">Check back later for new products.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="aspect-square bg-gray-100 overflow-hidden">
                                @if($product->hasImage())
                                    <img src="{{ $product->image_url }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-50 to-cyan-50">
                                        <svg class="w-20 h-20 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="p-4">
                                <h3 class="font-semibold text-lg text-gray-900 mb-2 line-clamp-1">
                                    {{ $product->name }}
                                </h3>
                                
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                    {{ $product->description }}
                                </p>

                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-2xl font-bold text-blue-600">
                                        {{ number_format($product->price, 2) }} EGP
                                    </span>
                                    
                                    @if($product->inStock())
                                        <span class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded-full">
                                            {{ $product->stock }} in stock
                                        </span>
                                    @else
                                        <span class="text-xs px-2 py-1 bg-red-100 text-red-700 rounded-full">
                                            Out of stock
                                        </span>
                                    @endif
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('products.show', $product) }}" 
                                       class="flex-1 text-center px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                                        View Details
                                    </a>
                                    
                                    @can('update', $product)
                                        <a href="{{ route('products.edit', $product) }}" 
                                           class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition"
                                           title="Edit Product">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                    @endcan

                                    @can('delete', $product)
                                        <form action="{{ route('products.destroy', $product) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this product?');"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition"
                                                    title="Delete Product">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
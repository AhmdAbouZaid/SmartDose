<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Product
            </h2>
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Products
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-cyan-400 px-6 py-4">
                    <h3 class="text-xl font-semibold text-white">Product Information</h3>
                    <p class="text-blue-100 text-sm mt-1">Fill in the details below to create a new product</p>
                </div>

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf

                    {{-- Product Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Product Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name') }}"
                               required
                               maxlength="255"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('name') border-red-500 @enderror"
                               placeholder="Enter product name">
                        @error('name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4"
                                  maxlength="1000"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('description') border-red-500 @enderror"
                                  placeholder="Enter product description">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Maximum 1000 characters</p>
                    </div>

                    {{-- Price and Stock Row --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Price --}}
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                Price (EGP) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" 
                                       name="price" 
                                       id="price" 
                                       value="{{ old('price') }}"
                                       required
                                       min="0"
                                       max="999999.99"
                                       step="0.01"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('price') border-red-500 @enderror"
                                       placeholder="0.00">
                                <span class="absolute right-3 top-2.5 text-gray-500 text-sm">EGP</span>
                            </div>
                            @error('price')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Stock --}}
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                                Stock Quantity <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   name="stock" 
                                   id="stock" 
                                   value="{{ old('stock') }}"
                                   required
                                   min="0"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('stock') border-red-500 @enderror"
                                   placeholder="0">
                            @error('stock')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Product Image --}}
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            Product Image
                        </label>
                        <div class="flex items-center space-x-4">
                            <label for="image" class="flex items-center justify-center w-full h-32 px-4 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-blue-500 transition @error('image') border-red-500 @enderror">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-1 text-sm text-gray-600">Click to upload image</p>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                </div>
                                <input type="file" 
                                       name="image" 
                                       id="image" 
                                       accept="image/*"
                                       class="hidden"
                                       onchange="previewImage(event)">
                            </label>
                        </div>
                        @error('image')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        
                        {{-- Image Preview --}}
                        <div id="imagePreview" class="mt-4 hidden">
                            <img id="preview" src="" alt="Preview" class="h-40 rounded-lg border border-gray-300">
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('products.index') }}" 
                           class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-gradient-to-r from-blue-600 to-cyan-400 text-white rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Create Product
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Image Preview Script --}}
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
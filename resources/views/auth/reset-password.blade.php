<x-guest-layout>
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-cyan-400 text-white text-center py-10 px-8">
        <h2 class="text-3xl font-semibold">Confirm Password</h2>
        <p class="text-sm mt-2 opacity-95">This is a secure area of the application</p>
    </div>

    <!-- Body -->
    <div class="p-8">
        <!-- Description -->
        <div class="mb-6 text-sm text-gray-600">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input 
                    id="password" 
                    type="password" 
                    name="password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('password') @enderror"
                    placeholder="Enter your password"
                    required 
                    autocomplete="current-password"
                >
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200"
            >
                Confirm
            </button>
        </form>
    </div>
</x-guest-layout>
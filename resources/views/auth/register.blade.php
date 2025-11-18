<x-guest-layout>
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-cyan-400 text-white text-center py-10 px-8">
        <h2 class="text-3xl font-semibold">Create Account</h2>
        <p class="text-sm mt-2 opacity-95">Join SmartDose for better health management</p>
    </div>

    <!-- Body -->
    <div class="p-8">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <input 
                    id="name" 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('name') @enderror"
                    placeholder="Enter your full name"
                    required 
                    autofocus 
                    autocomplete="name"
                >
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('email') @enderror"
                    placeholder="Enter your email"
                    required 
                    autocomplete="username"
                >
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input 
                    id="password" 
                    type="password" 
                    name="password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('password') @enderror"
                    placeholder="Create a password"
                    required 
                    autocomplete="new-password"
                >
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <input 
                    id="password_confirmation" 
                    type="password" 
                    name="password_confirmation"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('password_confirmation') @enderror"
                    placeholder="Confirm your password"
                    required 
                    autocomplete="new-password"
                >
                @error('password_confirmation')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200"
            >
                Create Account
            </button>
        </form>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white text-gray-500">Already have an account?</span>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                Log in here
            </a>
        </div>
    </div>
</x-guest-layout>
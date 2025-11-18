<x-guest-layout>
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-cyan-400 text-white text-center py-10 px-8">
        <h2 class="text-3xl font-semibold">Forgot Password?</h2>
        <p class="text-sm mt-2 opacity-95">We'll email you a password reset link</p>
    </div>

    <!-- Body -->
    <div class="p-8">
        <!-- Description -->
        <div class="mb-6 text-sm text-gray-600">
            No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('email') @enderror"
                    placeholder="Enter your email"
                    required 
                    autofocus
                >
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200"
            >
                Email Password Reset Link
            </button>
        </form>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white text-gray-500">Remember your password?</span>
            </div>
        </div>

        <!-- Back to Login Link -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                Back to login
            </a>
        </div>
    </div>
</x-guest-layout>
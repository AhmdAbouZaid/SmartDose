<x-guest-layout>
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-cyan-400 text-white text-center py-10 px-8">
        <h2 class="text-3xl font-semibold">Welcome Back</h2>
        <p class="text-sm mt-2 opacity-95">Login to access your SmartDose account</p>
    </div>

    <!-- Body -->
    <div class="p-8">
        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

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
                    autofocus 
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
                    placeholder="Enter your password"
                    required 
                    autocomplete="current-password"
                >
                @error('password')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-4">
                <input 
                    type="checkbox" 
                    id="remember_me" 
                    name="remember"
                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                >
                <label for="remember_me" class="ml-2 text-sm text-gray-600">
                    Remember me
                </label>
            </div>

            <!-- Forgot Password -->
            <div class="flex justify-between items-center mb-6">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200"
            >
                Log In
            </button>
        </form>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white text-gray-500">Don't have an account?</span>
            </div>
        </div>

        <!-- Register Link -->
        <div class="text-center">
            <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                Create new account
            </a>
        </div>
    </div>
</x-guest-layout>
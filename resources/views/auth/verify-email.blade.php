<x-guest-layout>
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-cyan-400 text-white text-center py-10 px-8">
        <h2 class="text-3xl font-semibold">Email Verification</h2>
        <p class="text-sm mt-2 opacity-95">Verify your email address to continue</p>
    </div>

    <!-- Body -->
    <div class="p-8">
        <!-- Description -->
        <div class="mb-6 text-sm text-gray-600">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </div>

        <!-- Success Status -->
        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="flex items-center justify-between gap-4">
            <!-- Resend Button -->
            <form method="POST" action="{{ route('verification.send') }}" class="flex-1">
                @csrf
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-blue-800 hover:-translate-y-0.5 hover:shadow-lg transition-all duration-200"
                >
                    Resend Verification Email
                </button>
            </form>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button 
                    type="submit" 
                    class="px-6 py-3 text-sm text-blue-600 hover:text-blue-800 font-medium transition"
                >
                    Log Out
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
<x-guest-layout>
    <div class="w-full">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center mb-4">
                <div class="bg-yellow-100 rounded-full p-4">
                    <i class="fas fa-envelope-open-text text-yellow-600 text-3xl"></i>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Verify Your Email</h2>
            <p class="text-gray-600">We've sent you a verification link</p>
        </div>

        <!-- Info Message -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-600 text-xl mr-3 mt-1"></i>
                <div>
                    <p class="text-gray-800 font-medium mb-2">Check your email inbox</p>
                    <p class="text-sm text-gray-700">
                        Before getting started, please verify your email address by clicking on the link we just emailed to you. 
                        If you didn't receive the email, we can send you another.
                    </p>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('status') == 'verification-link-sent')
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i>
                    <p class="text-green-800 text-sm">
                        <strong>Verification link sent!</strong> A new verification link has been sent to <strong>{{ auth()->user()->email }}</strong>
                    </p>
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="space-y-4">
            <!-- Resend Verification Email -->
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button 
                    type="submit" 
                    class="w-full border-2 border-black bg-transparent hover:bg-black text-black hover:text-white font-semibold py-3 px-4 rounded-lg transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                >
                    <i class="fas fa-paper-plane mr-2"></i>Resend Verification Email
                </button>
            </form>

            <!-- Log Out -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button 
                    type="submit" 
                    class="w-full border-2 border-black bg-transparent hover:bg-black text-black hover:text-white font-semibold py-3 px-4 rounded-lg transition"
                >
                    <i class="fas fa-sign-out-alt mr-2"></i>Log Out
                </button>
            </form>
        </div>

        <!-- Help Text -->
        <div class="mt-6 text-center text-sm text-gray-600">
            <p>
                <i class="fas fa-question-circle mr-1"></i>
                Didn't receive the email? Check your spam folder or 
                <a href="{{ route('verification.send') }}" 
                   onclick="event.preventDefault(); document.getElementById('resend-form').submit();" 
                   class="text-blue-600 hover:underline font-medium">
                    click here to resend
                </a>
            </p>
            <form id="resend-form" action="{{ route('verification.send') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>

        <!-- Email Address Display -->
        <div class="mt-6 p-4 bg-gray-50 rounded-lg text-center">
            <p class="text-sm text-gray-600 mb-1">Verification email sent to:</p>
            <p class="font-semibold text-gray-900">
                <i class="fas fa-envelope mr-2"></i>{{ auth()->user()->email }}
            </p>
        </div>
    </div>
</x-guest-layout>

<x-guest-layout>
    <x-auth-card>
        <!-- <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot> -->

        <h1 class="center text-center font-bold mt-4 mb-6">メールアドレス入力</h1>

        <div class="mb-4 text-sm text-gray-600">
            <!-- {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }} -->
            ご登録いただいたメールアドレスを入力してください。<br>
            パスワード再設定用のURLをメールにてお送りします。
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <div id="errors" class="text-sm text-red-600 mb-4"></div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="text
                " name="email" :value="old('email')" autofocus />
            </div>

            <div class="flex items-center justify-end my-4" id="mail_send_btn">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

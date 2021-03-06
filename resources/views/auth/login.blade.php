<x-guest-layout>
    <x-auth-card>
        <h1 class="center text-center font-bold mt-4 mb-6">ログイン画面</h1>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors  class="mb-4" :errors="$errors" />
        <div id="errors" class="text-sm text-red-600"></div>
        <div id="errors_p" class="mb-4 text-sm text-red-600"></div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Login ID -->
            <div>
                <x-label for="login_id" :value="__('Login ID')" />

                <x-input id="login_id"
                class="block mt-1 w-full text-xs"
                type="text"
                :value="old('login_id')"
                name="login_id"
                maxlength="16"
                autofocus
                placeholder="半角英数字8字以上16字以内" />
            </div>

            <!-- Password -->
            <div class="mt-4 password">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password"
                class="block mt-1 w-full text-xs"
                type="password"
                name="password"
                autocomplete="current-password"
                placeholder="半角英数字8字以上16字以内" />
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button id="login_btn" class="ml-8 my-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

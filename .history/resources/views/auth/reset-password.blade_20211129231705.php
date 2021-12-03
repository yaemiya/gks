<x-guest-layout>
    <x-auth-card>
        <!-- <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot> -->
        <h1 class="center text-center font-bold my-4">パスワード再設定</h1>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="my-4" :errors="$errors" />
        <div id="errors" class="text-sm text-red-600"></div>
        <div id="errors_p" class="mb-4 text-sm text-red-600"></div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Login ID -->
            <div>
                <x-label for="ligin_id" :value="__('Login ID')" />

                <x-input id="login_id"
                class="block mt-1 w-full text-xs"
                type="text"
                :value="old('login_id')"
                name="login_id"
                maxlength="8"
                autofocus
                placeholder="半角英数字8字" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full text-xs" type="password" name="password"
                placeholder="半角英数字8字以上16字以内" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4 text-xs">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full text-xs"
                                    type="password"
                                    name="password_confirmation"
                                    placeholder="半角英数字8字以上16字以内" />
            </div>

            <div class="flex items-center justify-end my-4">
                <x-button id="pwd_reset_btn">
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

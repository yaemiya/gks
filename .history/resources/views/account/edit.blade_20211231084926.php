@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/account.js') }}" defer></script>
@endsection

@section('content')
    <div>
        <p class="pageView">アカウント ＞ 編集</p>
        <div class="formContainerForPut">
            <div class="formMainForPut">
                <div class="title ">ユーザー編集</div>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="post" action="/account/update/{{ $user->user_id }}">
                    @csrf
                    <!-- Login ID -->
                    <div>
                        <x-label for="login_id" :value="__('Login ID')" />
                        <x-input id="login_id" class="block mt-1 w-full text-xs" type="text" :value="old('login_id', $user->login_id)"
                            name="login_id" maxlength="16" autofocus placeholder="必須 半角英数字および「.-_」8-16字" />
                        <div id="login_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Emp No -->
                    <div class="mt-4">
                        <x-label for="emp_no" value="社員番号" />
                        <x-input id="emp_no" class="block mt-1 w-full text-xs" type="text" :value="old('emp_no', $user->emp_no)"
                            name="emp_no" maxlength="4" autofocus placeholder="必須 半角英数字4字" />
                        <div id="emp_no_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Last Name -->
                    <div class="mt-4">
                        <x-label for="last_name" value="姓" />

                        <x-input id="last_name" class="block mt-1 w-full text-xs" type="text" :value="old('last_name', $user->last_name)"
                            name="last_name" maxlength="20" placeholder="必須" />
                        <div id="last_name_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- First Name -->
                    <div class="mt-4">
                        <x-label for="first_name" value="名" />

                        <x-input id="first_name" class="block mt-1 w-full text-xs" type="text" :value="old('first_name', $user->first_name)"
                            name="first_name" maxlength="20" placeholder="必須" />
                        <div id="first_name_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="block mt-1 w-full text-xs" type="text" :value="old('email', $user->email)" name="email"
                            maxlength="50" placeholder="必須" />
                        <div id="email_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Password -->
                    <div class="mt-4 password">
                        <x-label for="password" :value="__('Password')" />

                        <x-input id="password" class="block mt-1 w-full text-xs" type="password" name="password"
                            maxlength="16" autocomplete="current-password" placeholder="必須 半角英数字8字以上16字以内" />
                        <div id="password_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-input id="password_confirmation" class="block mt-1 w-full text-xs" type="password"
                            name="password_confirmation" maxlength="16" placeholder="必須" />
                        <div id="password_confirmation_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Tel -->
                    <div class="mt-4">
                        <x-label value="電話番号" />
                        <div>
                            <div class="flex">
                                <x-input id="tel" class="block mt-1 w-full text-xs" type="text" :value="old('tel', $user->tel)"
                                    name="tel" maxlength="11" placeholder="必須" />
                            </div>
                            <div id="tel_err" class="text-sm text-red-600"></div>
                        </div>

                        <!-- Role -->
                        <div class="mt-4">
                            <x-label for="role" value="権限" />

                            <select id="role" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full text-xs border-g-50" type="text" name="role">
                                <option value="" class="hidden" disabled selected>選択してください</option>
                                <option value="1" @if (old('role', $user->role) === '1')
                                    selected
                                    @endif
                                    >管理</option>
                                <option value="2" @if (old('role', $user->role) === '2')
                                    selected
                                    @endif
                                    >閲覧</option>
                            </select>
                            <div id="role_err" class="text-sm text-red-600"></div>
                        </div>
                        <div class="text-right">
                            <button id="validationBtn" class="putBtn btn-blue">更新</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- モーダルエリアここから -->
    <section id="modalArea" class="modalArea">
        <div id="modalBg" class="modalBg"></div>
        <div class="modalWrapper">
            <div class="modalContent">
                <p class="text-center">ユーザー{{ $user->user_id }}を本当に更新しますか？</p>
            <div class="flex place-content-center space-x-8 mt-6">
                    <button" id="updateBtn" class="btn btn-blue" value="更新">
                </form>
                <button id="closeModal" class="btn btn-gray">キャンセル</button>
            </div>
            <div id="closeModal" class="closeModal">
                ×
            </div>
        </div>
    </section>
    <!-- モーダルエリアここまで -->
@endsection

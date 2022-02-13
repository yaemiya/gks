@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/master.js') }}" defer></script>
@endsection

@section('content')
    <div class="bg">
        <p class="pageView">マスタ ＞ 施設 ＞ 仕入業者 ＞ 新規登録</p>
        <div class="formContainerForPut">
            <div class="formMainForPut">
                <div class="title">仕入業者 新規登録</div>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="store">
                    @csrf
                    <input type="hidden" name="errFlg" id="errFlg" value="">

                    <!-- 会社名/屋号 -->
                    <div>
                        <x-label for="login_id" value="会社名/屋号" />
                        <input id="supplier_name" class="block mt-1 w-full text-xs" type="text"
                            :value="old('supplier_name')" name="supplier_name" maxlength="30" autofocus
                            placeholder="必須 30字以内" />
                        <div id="supplier_name_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 代表者名 -->
                    <div class="mt-4">
                        <x-label for="rep_name" value="代表者名" />
                        <x-input id="rep_name" class="block mt-1 w-full text-xs" type="text" :value="old('rep_name')"
                            name="rep_name" maxlength="30" autofocus placeholder="必須 30字以内" />
                        <div id="rep_name_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Tel -->
                    <div class="mt-4">
                        <x-label value="郵便番号" />
                        <div class="flex">
                            <x-input id="postal_code_1" class="block mt-1 mr-3 w-1/4 text-xs" type="text" :value="old('postal_code_1')"
                                name="postal_code_1" maxlength="3" placeholder="必須" />
                            _
                            <x-input id="postal_code_2" class="block mt-1 mx-3 w-1/4 text-xs" type="text" :value="old('postal_code_2')"
                                name="postal_code_2" maxlength="4" placeholder="必須" />
                            <button id="postal_code_btn"
                        </div>
                        <div id="postal_code_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Last Name -->
                    <div class="mt-4">
                        <x-label for="last_name" value="姓" />

                        <x-input id="last_name" class="block mt-1 w-full text-xs" type="text" :value="old('last_name')"
                            name="last_name" maxlength="20" placeholder="必須" />
                        <div id="last_name_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- First Name -->
                    <div class="mt-4">
                        <x-label for="first_name" value="名" />

                        <x-input id="first_name" class="block mt-1 w-full text-xs" type="text" :value="old('first_name')"
                            name="first_name" maxlength="20" placeholder="必須" />
                        <div id="first_name_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="block mt-1 w-full text-xs" type="text" :value="old('email')" name="email"
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
                        <div class="flex">
                            <x-input id="postal_code_1" class="block mt-1 mr-3 w-1/3 text-xs" type="text" :value="old('postal_code_1')"
                                name="postal_code_1" maxlength="5" placeholder="必須" />
                            _
                            <x-input id="postal_code_2" class="block mt-1 mx-3 w-1/3 text-xs" type="text" :value="old('postal_code_2')"
                                name="postal_code_2" maxlength="5" placeholder="必須" />
                            _
                            <x-input id="postal_code_3" class="block mt-1 ml-3 w-1/3 text-xs" type="text" :value="old('postal_code_3')"
                                name="postal_code_3" maxlength="5" placeholder="必須" />
                        </div>
                        <div id="postal_code_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Role -->
                    <div class="mt-4">
                        <x-label for="role" value="権限" />

                        <select id="role"
                            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full text-xs"
                            type="text" name="role">
                            <option value="" class="hidden" disabled selected>選択してください</option>
                            <option value="1" @if (old('role') === '1')
                                selected
                                @endif
                                >管理</option>
                            <option value="2" @if (old('role') === '2')
                                selected
                                @endif
                                >閲覧</option>
                        </select>
                        <div id="role_err" class="text-sm text-red-600"></div>
                    </div>
                    <div class="text-right">
                        <button id="validationBtn" class="putBtn btn-green">新規登録</button>
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
                <p class="text-center">ユーザーを本当に登録しますか？</p>
                <div class="flex place-content-center space-x-8 mt-6">
                    <button id="registerBtn" class="btn btn-green">新規登録</button>
                    <button id="closeModal" class="btn btn-gray">キャンセル</button>
                </div>
                <div id="closeModal" class="closeModal">
                    ×
                </div>
            </div>
    </section>
    <!-- モーダルエリアここまで -->
@endsection

@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/master.js') }}" defer></script>
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
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

                    <!-- 会社名／屋号 -->
                    <div>
                        <x-label for="login_id" value="会社名／屋号" />
                        <input id="supplier_name" class="block mt-1 w-full text-xs" type="text" :value="old('supplier_name')"
                            name="supplier_name" maxlength="30" autofocus placeholder="必須" />
                        <div id="supplier_name_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 代表者名 -->
                    <div class="mt-4">
                        <x-label for="rep_name" value="代表者名" />
                        <x-input id="rep_name" class="block mt-1 w-full text-xs" type="text" :value="old('rep_name')"
                            name="rep_name" maxlength="30" autofocus placeholder="必須" />
                        <div id="rep_name_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 郵便番号 -->
                    <div class="mt-4">
                        <x-label value="郵便番号" />
                        <div class="flex">
                            <x-input id="postal_code_1" class="block mt-1 mr-3 w-1/4 text-xs" type="text"
                                :value="old('postal_code_1')" name="postal_code_1" maxlength="3" placeholder="必須" />
                            _
                            <x-input id="postal_code_2" class="block mt-1 mx-3 w-1/4 text-xs" type="text"
                                :value="old('postal_code_2')" name="postal_code_2" maxlength="4" placeholder="必須" />
                            <button type="button" id="postal_code_btn" class="btn-black addressSearchBtn" onClick="AjaxZip3.zip2addr('postal_code_1', 'postal_code_2', 'prefecture', 'address');">住所検索</button>
                        </div>
                        <div id="postal_code_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 都道府県 -->
                    <div class="mt-4">
                        <x-label for="prefecture" value="都道府県" />
                        <x-input id="prefecture" class="block mt-1 w-full text-xs" type="text" :value="old('prefecture')"
                            name="prefecture" maxlength="4" placeholder="必須" />
                        <div id="prefecture_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 住所 -->
                    <div class="mt-4">
                        <x-label for="address" value="住所" />
                        <x-input id="address" class="block mt-1 w-full text-xs" type="text" :value="old('address')"
                            name="address" maxlength="20" placeholder="必須" />
                        <div id="address_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 番地 -->
                    <div class="mt-4">
                        <x-label for="house_num" value="番地" />
                        <x-input id="house_num" class="block mt-1 w-full text-xs" type="text" :value="old('house_num')"
                            name="house_num" maxlength="20" placeholder="必須" />
                        <div id="house_num_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 建物 -->
                    <div class="mt-4">
                        <x-label for="building" value="建物" />
                        <x-input id="building" class="block mt-1 w-full text-xs" type="text" :value="old('building')"
                            name="building" maxlength="20" />
                        <div id="building_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- メール -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" class="block mt-1 w-full text-xs" type="text" :value="old('email')" name="email"
                            maxlength="50" placeholder="必須" />
                        <div id="email_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Tel -->
                    <div class="mt-4">
                        <x-label value="電話番号" />
                        <div class="flex">
                            <x-input id="tel_1" class="block mt-1 mr-3 w-1/3 text-xs" type="text" :value="old('tel_1')"
                                name="tel_1" maxlength="5" placeholder="必須" />
                            _
                            <x-input id="tel_2" class="block mt-1 mx-3 w-1/3 text-xs" type="text" :value="old('tel_2')"
                                name="tel_2" maxlength="5" placeholder="必須" />
                            _
                            <x-input id="tel_3" class="block mt-1 ml-3 w-1/3 text-xs" type="text" :value="old('tel_3')"
                                name="tel_3" maxlength="5" placeholder="必須" />
                        </div>
                        <div id="tel_err" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 取引工場/店舗 -->
                    <div class="mt-4">
                        <x-label for="email" value="取引工場／店舗" />
                        <table class="registerTable text-xs">
                            <thead class="thead">
                                <tr>
                                    <th class="th w-1/3">種別</th>
                                    <th class="th w-2/3 list">取引工場／店舗（ID）</th>
                                </tr>
                            </thead>
                            <tr class="tr">
                                <td class="registerTd">
                                    <select id="role"
                                        class="pl-4 shadow-sm border-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full text-xs"
                                        type="text" name="role">
                                        <option value="" class="hidden" disabled selected>選択してください</option>
                                        <option value="2" @if (old('role') === '2')
                                            selected
                                            @endif
                                            >工場</option>
                                        <option value="3" @if (old('role') === '3')
                                            selected
                                            @endif
                                            >店舗</option>
                                    </select>
                                </td>
                                <td id="openSelectModal" class="td bg-white"></td>
                            </tr>
                        </table>
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

    <!-- 選択モーダルエリアここから -->
    <section id="selectModalArea" class="modalArea">
        <div id="modalBg" class="modalBg"></div>
        <div class="SelectmodalWrapper">
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
    <!-- 選択モーダルエリアここまで -->
@endsection

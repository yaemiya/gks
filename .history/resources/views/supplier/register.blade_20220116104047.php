@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/supplier.js') }}" defer></script>
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
                        <x-label for="supplierName" value="会社名／屋号" />
                        <x-input id="supplierName" class="block mt-1 w-full text-xs" type="text" :value="old('supplierName')"
                            name="supplierName" maxlength="30" autofocus placeholder="必須" />
                        <div id="supplierNameErr" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 代表者名 -->
                    <div class="mt-4">
                        <x-label for="repName" value="代表者名" />
                        <x-input id="repName" class="block mt-1 w-full text-xs" type="text" :value="old('repName')"
                            name="repName" maxlength="30" autofocus placeholder="必須" />
                        <div id="repNameErr" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 郵便番号 -->
                    <div class="mt-4">
                        <x-label value="郵便番号" />
                        <div class="flex">
                            <x-input id="postalCode1" class="block mt-1 mr-3 w-1/4 text-xs" type="text"
                                :value="old('postalCode1')" name="postalCode1" maxlength="3" placeholder="必須" />
                            _
                            <x-input id="postalCode2" class="block mt-1 mx-3 w-1/4 text-xs" type="text"
                                :value="old('postalCode2')" name="postalCode2" maxlength="4" placeholder="必須" />
                            <button type="button" class="btn-black addressSearchBtn"
                                onClick="AjaxZip3.zip2addr('postalCode1', 'postalCode2', 'prefecture', 'address');">住所検索</button>
                        </div>
                        <div id="postalCodeErr" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 都道府県 -->
                    <div class="mt-4">
                        <x-label for="prefecture" value="都道府県" />
                        <x-input id="prefecture" class="block mt-1 w-full text-xs" type="text" :value="old('prefecture')"
                            name="prefecture" maxlength="4" placeholder="必須" />
                        <div id="prefectureErr" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 住所 -->
                    <div class="mt-4">
                        <x-label for="address" value="住所" />
                        <x-input id="address" class="block mt-1 w-full text-xs" type="text" :value="old('address')"
                            name="address" maxlength="50" placeholder="必須" />
                        <div id="addressErr" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 番地 -->
                    <div class="mt-4">
                        <x-label for="houseNum" value="番地" />
                        <x-input id="houseNum" class="block mt-1 w-full text-xs" type="text" :value="old('houseNum')"
                            name="houseNum" maxlength="10" placeholder="必須" />
                        <div id="houseNumErr" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 建物 -->
                    <div class="mt-4">
                        <x-label for="building" value="建物" />
                        <x-input id="building" class="block mt-1 w-full text-xs" type="text" :value="old('building')"
                            name="building" maxlength="50" />
                        <div id="buildingErr" class="text-sm text-red-600"></div>
                    </div>

                    <!-- メール -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" class="block mt-1 w-full text-xs" type="text" :value="old('email')" name="email"
                            maxlength="50" placeholder="必須" />
                        <div id="emailErr" class="text-sm text-red-600"></div>
                    </div>

                    <!-- Tel -->
                    <div class="mt-4">
                        <x-label value="電話番号" />
                        <div class="flex">
                            <x-input id="tel1" class="block mt-1 mr-3 w-1/3 text-xs" type="text" :value="old('tel1')"
                                name="tel1" maxlength="5" placeholder="必須" />
                            _
                            <x-input id="tel2" class="block mt-1 mx-3 w-1/3 text-xs" type="text" :value="old('tel2')"
                                name="tel2" maxlength="5" placeholder="必須" />
                            _
                            <x-input id="tel_3" class="block mt-1 ml-3 w-1/3 text-xs" type="text" :value="old('tel_3')"
                                name="tel_3" maxlength="5" placeholder="必須" />
                        </div>
                        <div id="telErr" class="text-sm text-red-600"></div>
                    </div>

                    <!-- 取引工場/店舗 -->
                    <div class="mt-4">
                        <x-label value="取引工場／店舗" />
                        <table class="registerTable text-xs">
                            <thead class="thead">
                                <tr>
                                    <th class="th w-1/3">種別</th>
                                    <th class="th w-2/3 list">取引工場／店舗（ID）</th>
                                </tr>
                            </thead>
                            <tr class="tr">
                                <td class="registerTd">
                                    <select id="businessKind"
                                        class="pl-4 shadow-sm border-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full text-xs"
                                        type="text" name="businessKind
                                                    ">
                                        <option value="" class="hidden" disabled selected>選択してください</option>
                                        <option id="plant" value="2" @if (old('businessKind') === '2')
                                            selected
                                            @endif
                                            >工場</option>
                                        <option value="3" @if (old('businessKind') === '3')
                                            selected
                                            @endif
                                            >店舗</option>
                                    </select>
                                    <div id="businessKindErr" class="text-sm text-red-600"></div>
                                </td>
                                {{-- <td id="openSelectModal" class="td bg-white"></td> --}}
                                <td id="plantSelectBox" class="td bg-white">
                                    <select id="plantList"
                                        class="hidden pl-4 shadow-sm border-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full text-xs"
                                        type="text" name="plantList">
                                        <option value="" class="hidden" disabled selected>選択してください</option>
                                        @foreach ($plants as $plant)
                                            <option value="{{ $plant->plant_id }}" @if (old('plantList') === '{{ $plant->plant_id }}')
                                                selected
                                        @endif
                                        >{{ $plant->plant_name }}（{{ $plant->plant_id }}）</option>
                                        @endforeach
                                    </select>
                                    <span></span>
                                </td>
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
        <div id="selectModalBg" class="modalBg"></div>
        <div class="selectModalWrapper">
            <div class="modalContent w-auto">
                <p class="text-center font-bold">店舗選択</p>
                <div class="flex  mt-6 h-8">
                    <button id="searchrBtn" class="searchBtn btn-black h-8 align-middle py-1 px-3 text-xs">検索</button>
                    <input type="search" id="searchBox" class="searchBox py-1 px-3 text-xs" placeholder="キーワードを入力">
                </div>
                <div class="border border-black mt-8">
                    <div class="text-center border-b border-black py-1 px-3 text-xs selectModalList">店舗（ID）</div>
                    <div id="shopList">
                        <ul>
                            @foreach ($shops as $shop)
                                <li class="py-1 px-3 text-xs border-b"><a href=#>{{ $shop->shop_name }}（{{ $shop->shop_id }}）</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div id="closeSelectModal" class="closeModal">
                    ×
                </div>
            </div>
    </section>
    <!-- 選択モーダルエリアここまで -->
@endsection

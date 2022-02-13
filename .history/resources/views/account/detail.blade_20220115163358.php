@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/account.js') }}" defer></script>
@endsection

@section('content')

    <p class="pageView">アカウント ＞ 詳細</p>
    <div class="formContainer">
        <div class="formMain">
            <div class="title">ユーザー詳細</div>
            <div class="flex place-content-end space-x-3">
                @if(Auth::user()->role === '1')
                <button id="editBtn" class="btn btn-green" data-user_id="{{ $user->user_id }}">編集</button>
                <button id="openModal" class="btn btn-red" data-user_id="{{ $user->user_id }}">削除</button>
                @else
                <button class="btn btn-disabled notAllowed" >編集</button>
                <button  class="btn btn-disabled notAllowed" >削除</button>
                @endif
            </div>
            <table class="table">
                <tr class="tr">
                    <th class="th">ユーザーID</th>
                    <td class="td py-4">{{ $user->user_id }}</td>
                </tr>
                <tr class="tr">
                    <th class="th">ログインID</th>
                    <td class="td py-4">{{ $user->login_id }}</td>
                </tr>
                <tr class="tr">
                    <th class="th">社員番号</th>
                    <td class="td py-4">{{ $user->emp_no }}</td>
                </tr>
                <tr class="tr">
                    <th class="th">姓</th>
                    <td class="td py-4">{{ $user->last_name }}</td>
                </tr>
                <tr class="tr">
                    <th class="th">名</th>
                    <td class="td py-4">{{ $user->first_name }}</td>
                </tr>
                <tr class="tr">
                    <th class="th">メールアドレス</th>
                    <td class="td py-4">{{ $user->email }}</td>
                </tr>
                <tr class="tr">
                    <th class="th">電話番号</th>
                    <td class="td py-4">{{ $user->tel }}</td>
                </tr>
                <tr class="tr">
                    <th class="th">権限</th>
                    @if ($user->role === '1')
                        <td class="td py-4">管理</td>
                    @else
                        <td class="td py-4">閲覧</td>
                    @endif
                </tr>
            </table>
        </div>
    </div>

    <!-- モーダルエリアここから -->
    <section id="modalArea" class="modalArea">
        <div id="modalBg" class="modalBg"></div>
        <div class="modalWrapper">
            <div class="modalContent">
                <p class="text-center">ユーザー{{ $user->user_id }}を本当に削除しますか？</p>
            <div class="flex place-content-center space-x-8 mt-6">
                <form method="post" action="/account/delete/{{ $user->user_id }}">
                    @csrf
                    <input type="submit" id="deleteBtn" class="btn btn-red" value="削除">
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

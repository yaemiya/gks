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
                <button id="editBtn" class="btn btn-green" data-user_id="{{ $user->user_id }}">編集</button>
                <form method="post" action="/account/delete/{{ $user->user_id }}">
                    @csrf
                    <input type="submit" id="openModal" class="btn btn-red" value="削除">
                </form>
            </div>
            <table width="800">
                <tr>
                    <th>ユーザーID</th>
                    <td>{{ $user->user_id }}</td>
                </tr>
                <tr>
                    <th>ログインID</th>
                    <td>{{ $user->login_id }}</td>
                </tr>
                <tr>
                    <th>社員番号</th>
                    <td>{{ $user->emp_no }}</td>
                </tr>
                <tr>
                    <th>姓</th>
                    <td>{{ $user->last_name }}</td>
                </tr>
                <tr>
                    <th>名</th>
                    <td>{{ $user->first_name }}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ $user->tel }}</td>
                </tr>
                <tr>
                    <th>権限</th>
                    @if ($user->role === '1')
                        <td>管理</td>
                    @else
                        <td>閲覧</td>
                    @endif
                </tr>
            </table>
        </div>
    </div>

    <!-- モーダルエリアここから -->
    <section id="modalArea" class="modalArea">
        <div id="modalBg" class="modalBg"></div>
        <div class="modalWrapper">
            <div class="modalContents">
                <h1>Here are modal contents!</h1>
                <p>ユーザー１を本当に削除しますか？</p>
                <form method="post" action="/account/delete/{{ $user->user_id }}">
                    @csrf
                    <input type="submit" id="openModal" class="btn btn-red" value="削除">
                </form>
            </div>
            <div id="closeModal" class="closeModal">
                ×
            </div>
        </div>
    </section>
    <!-- モーダルエリアここまで -->
@endsection

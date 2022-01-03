@extends('layouts.appForRegister')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/account.js') }}" defer></script>
@endsection

@section('content')

    <p class="pageView">アカウント ＞ 一覧</p>
    <div class="container">
        <div class="title">ユーザー一覧</div>
        <div class="text-right pr-30">
            <button id="editBtn" class="btn btn-green">編集</button>
            <button id="deleteBtn" class="btn btn-red">削除</button>
        </div>
        <table width="1000">
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

@endsection

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
            <div class="text-right">
                <div>
                <button id="editBtn" class="btn btn-green" data-user_id="{{ $user->user_id }}">編集</button>
                </div>
                <div></div>
                <form type="submit" action="/account/delete/"{{ $user->user_id }}"
                    <input id="deleteBtn" class="btn btn-red" value="削除">
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
    @endsection

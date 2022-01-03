@extends('layouts.app')

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
        <div class="text-right">
            <button id="editBtn" class="btn btn-green">編集</button>
            <button id="deleteBtn" class="btn btn-red">削除</button>
        </div>
        <table width="1000">
            <tr>
                <th>ユーザーID</th>
                <td>{{ $user->user_id }}</td>
            </tr>
            <tr>
                <th></th>
                
            </tr>
        </table>
    </div>


@endsection

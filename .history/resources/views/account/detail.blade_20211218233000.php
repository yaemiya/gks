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
            <thead>
                <tr class="tr">
                    <th class="th">ユーザーID</th>
                    <th class="th">社員番号</th>
                    <th class="th">ユーザー名</th>
                    <th class="th">権限</th>
                </tr>
            </thead>
            <tbody class="tbody">
                @foreach ($users as $user)
                    <tr class="tr">
                        <td class="td">{{ $user->user_id }}</td>
                        <td class="td">{{ $user->emp_no }}</td>
                        <td class="td"><a href="account/detail/{{ $user->user_id }}">{{ $user->last_name . ' ' . $user->first_name }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection

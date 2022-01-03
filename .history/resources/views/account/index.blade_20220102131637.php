@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/account.js') }}" defer></script>
@endsection

@section('content')

    <p class="pageView">アカウント ＞ 一覧</p>
    <div class="formContainer">
        <div class="formMain">
            <div class="title">ユーザー一覧</div>
            <div class="text-right"><?php dd(Auth::user()->role) ?>
                @if(Auth::user()->role === '1')
                <button id="createBtn" class="btn btn-green">新規登録</button>
                @else
                <button id="createBtn" class="btn btn-gray">新規登録</button>
                @endif
            </div>
            <table width="800">
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
                            <td class="td"><a
                                    href="account/detail/{{ $user->user_id }}">{{ $user->last_name . ' ' . $user->first_name }}</a>
                            </td>
                            @if ($user->role === '1')
                                <td class="td" id="role" data-role="{{ $user->role }}">管理</td>
                            @else
                                <td class="td" id="role" data-role="{{ $user->role }}">閲覧</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

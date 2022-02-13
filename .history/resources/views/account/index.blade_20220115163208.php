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
            <div class="text-right">
                @if(Auth::user()->role === '1')
                <button id="createBtn" class="btn btn-green" data-role="{{ Auth::user()->role }}">新規登録</button>
                @else
                <button id="createBtn" class="btn btn-disabled notAllowed">新規登録</button>
                @endif
            </div>
            <table class="table">
                <thead class="thead">
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
                            <td class="td px-4">{{ $user->user_id }}</td>
                            <td class="td px-4">{{ $user->emp_no }}</td>
                            <td class="td px-4"><a
                                    href="account/detail/{{ $user->user_id }}">{{ $user->last_name . ' ' . $user->first_name }}</a>
                            </td>
                            @if ($user->role === '1')
                                <td class="td px-4" id="role">管理</td>
                            @else
                                <td class="td px-4" id="role">閲覧</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

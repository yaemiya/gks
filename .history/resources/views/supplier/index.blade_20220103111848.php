@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/master.js') }}" defer></script>
@endsection

@section('content')

    <p class="pageView">マスタ ＞ 施設 ＞ 仕入業者 ＞ 一覧</p>
    <div class="formContainer">
        <div class="formMain">
            <div class="title">仕入業者一覧</div>
            <div class="text-right">
                @if (Auth::user()->role === '1')
                    <button id="createBtn" class="btn btn-green">新規登録</button>
                @else
                    <button id="createBtn" class="btn btn-disabled notAllowed">新規登録</button>
                @endif
            </div>
            <table width="800">
                <thead>
                    <tr class="tr">
                        <th class="th Id">仕入業者ID</th>
                        <th class="th tName">会社名／屋号</th>
                        <th class="th">代表者名</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach ($suppliers as $supplier)
                        <tr class="tr">
                            <td class="td">{{ $supplier->supplier_id }}</td>
                            <td class="td"><a
                                    href="account/detail/{{ $supplier->supplier_id }}">{{ $supplier->supplier_name }}</a>
                            </td>
                                <td class="td" {{ $supplier->supplier_rep_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')

    <p class="pageView">アカウント ＞ 一覧</p>
    <div class="container">
        <div class="title text-red-500">エラー</div>
        <div class="mt-10 mb-5 text-center">{{ $message }}</div>
    </div>

@endsection

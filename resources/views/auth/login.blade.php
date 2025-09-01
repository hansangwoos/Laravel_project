@extends('layouts.layout')

@section('title', 'login')


@section('content')

    @auth
        <h1>로그인된 사용자</h1>
    @endauth

    @guest
        <h1>로그인이 안된 사용자</h1>
    @endguest

@endsection

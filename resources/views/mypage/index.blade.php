@extends('layout.index')
@section('title', 'mypage')
@section('description', 'description')
@section('body')
<h3>mypage</h3>
<p>name: {{ Auth::user()->name }}</p>
<p>email: {{ Auth::user()->email }}</p>
@endsection
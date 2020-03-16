@extends('admin/_layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')
{{ session("staff_data.name") }}さん
@endsection

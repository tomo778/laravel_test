@extends('layout.index')
@section('title', 'カテゴリ別')
@section('description', 'description')
@section('body')
<h2>{{$title}}一覧</h2>
<div id="blogarea">
    @foreach (@$paginate as $k => $v)
    @include('layout.part_item')
    @endforeach
</div>
{{ $paginate->links('pagination::bootstrap-4') }}
@endsection
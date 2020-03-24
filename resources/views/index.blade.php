@extends('layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')
<div id="blogarea">
    @foreach (@$datas as $k => $v)
    @include('layout.part_item')
    @endforeach
</div>
{{ $paginate->links('pagination::bootstrap-4') }}
@endsection
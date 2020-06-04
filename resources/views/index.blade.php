@extends('layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')
<div id="blogarea">
    @foreach (@$pagination as $k => $v)
    @include('layout.part_item')
    @endforeach
</div>
{{ $pagination->links('pagination::bootstrap-4') }}
@endsection
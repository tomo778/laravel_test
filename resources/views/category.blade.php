@extends('layout.index')
@section('title', 'カテゴリ別')
@section('description', 'description')
@section('body')
<h2>{{$bc['category_name']}}一覧</h2>
<div id="blogarea">
    @foreach (@$datas as $k => $v)
    <article class="blog">
        <div class="thumb"><a href="/news/{{$v['id']}}"><img src="/img/dummy.jpg" alt="dummy" /></a></div>
        <div class="bbox">
            <div class="title"><a href="/news/{{$v['id']}}">{{$v['title']}}</a></div>
            <div class="body">{{number_format($v['price'])}}円</div>
            <div class="info">
                @foreach ($v['category'] as $k2 => $v2)
                <span class="plist"><a href="/category/{{$v2['category_id']}}">{{$v2['title']}}</a></span>
                @endforeach
                <time>{{$v['created_at']}}</time>
            </div>
        </div>
    </article>
    @endforeach
</div>
{{ $paginate->links('pagination::bootstrap-4') }}
@endsection
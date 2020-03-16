@extends('layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')

<article>
<h2 class="blog-post-title">{{$result['title']}}</h2>
    <p class="blog-post-meta">{{$result['created_at']}}</p>
    @foreach (@$categorys as $k2 => $v2)
    {{$v2->title}}
    @endforeach

    <div id="text1">
        <p>{!! nl2br(e($result['text'])) !!}</p>
<!-- 
        <h4>サイト作成の流れ(通常モード)</h4>
        <div class="question1">ここに質問を入力</div>
        <div class="answer1">
            <p>ここに回答を入力</p>
        </div>
        <div class="thint noimage">
            <p>aaa</p>
        </div>
        <div class="user1 noimage">
            <p>aaaaa</p>
        </div>
        <p>≫サイト作成マニュアル(通常モード)の動画はこちら≪</p>
        <div class="attention noimage">
            <p>aaaaaaaaa</p>
        </div> -->
    </div>

</article>
@endsection
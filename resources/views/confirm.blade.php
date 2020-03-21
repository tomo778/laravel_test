@extends('layout.index')
@section('title', 'お問い合わせ')
@section('description', 'description')
@section('body')
<h2>お問い合わせ</h2>
{{ csrf_field() }}
<p>
    名前：<br>
    <p>{{@$Request['name']}}</p>
</p>
<hr>
<p>
    ご感想：<br>
    <p>{!! nl2br(e(@$Request['kanso'])) !!}</p>
</p>
<p>
    <form action="/contact/" method="post">
    {{ csrf_field() }}
        <input type="submit" value="戻る">
    </form>
    <form action="/contact/finish/" method="post">
    {{ csrf_field() }}
        <input type="submit" value="送信">
    </form>
</p>
@endsection
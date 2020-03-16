@extends('layout.index')
@section('title', 'お問い合わせ')
@section('description', 'description')
@section('body')
<form action="/contact/confirm/" method="post">
{{ csrf_field() }}
    <p>
        名前：<br>
        <input type="text" name="name" value="{{@$Request['name']}}" size="40">
        <br>
        {{@$errors->first('name')}}
    </p>
    <hr>
    <p>
        ご感想：<br>
        <textarea name="kanso" rows="4" cols="40">{{@$Request['kanso']}}</textarea>
        <br>
        {{@$errors->first('kanso')}}
    </p>
    <p>
        <input type="submit" value="確認画面へ">
    </p>
</form>
@endsection
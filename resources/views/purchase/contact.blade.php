@extends('layout.index')
@section('title', 'お問い合わせ')
@section('description', 'description')
@section('body')
<h4>購入手続き</h4>
<form action="/purchase/confirm/" method="post">
    {{ csrf_field() }}
    <p>
        名前：<br>
        <input type="text" name="name" value="{{@$Request['name']}}" size="40">
        <br>
        {{@$errors->first('name')}}
    </p>
    <hr>
    <p>
        住所：<br>
        <textarea name="address" rows="4" cols="40">{{@$Request['address']}}</textarea>
        <br>
        {{@$errors->first('address')}}
    </p>
    <hr>
    <p>
        支払方法：<br>
        <select name="payway">
            @foreach (Config::get('const.payway') as $k => $v)
            <option value="{{$k}}" @if (@$Request['payway']==$k) selected @endif>{{$v}}</option>
            @endforeach
        </select>
    </p>
    <hr>
    <p>
        <input type="submit" value="確認画面へ">
    </p>
</form>
@endsection
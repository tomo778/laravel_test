@extends('layout.index')
@section('title', 'お問い合わせ')
@section('description', 'description')
@section('body')
<h4>購入手続き</h4>
<form action="{{ route('purchase_confirm') }}" method="post">
    {{ csrf_field() }}
    <p>
        名前：<br>
        <input type="text" name="name" value="{{ old('name' , @$Request['name'] ) }}" size="40">
        <br>
        <div class="err">{{@$errors->first('name')}}</div>
    </p>
    <hr>
    <p>
        住所：<br>
        <textarea name="address" rows="4" cols="40">{{ old('address' , @$Request['address'] ) }}</textarea>
        <br>
        <div class="err">{{@$errors->first('address')}}</div>
    </p>
    <hr>
    <p>
        支払方法：<br>
        <select name="payway">
            @foreach (Config::get('const.payway') as $k => $v)
            <option value="{{$k}}" @if (old('payway' , @$Request['payway'] ) == $k) selected @endif>{{$v}}</option>
            @endforeach
        </select>
    </p>
    <hr>
    <p>
        <input type="submit" value="確認画面へ">
    </p>
</form>
@endsection
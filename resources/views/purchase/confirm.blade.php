@extends('layout.index')
@section('title', 'お問い合わせ')
@section('description', 'description')
@section('body')
{{ csrf_field() }}
<h4>お客様情報</h4>
<p>
    名前：<br>
    <p>{{@$Request['name']}}</p>
</p>
<hr>
<p>
    住所：<br>
    <p>{!! nl2br(e(@$Request['address'])) !!}</p>
</p>
<h4>購入商品</h4>
<table class="table">
    <tbody>
        @foreach($cart['items'] as $k => $v)
        <tr>
        <td><img src="/img/dummy.jpg" alt="dummy" width="100"></td>
            <td>{{$v['title']}}</td>
            <td>{{number_format($v['price'])}}円</td>
            <td>{{$v['quantity']}}個</td>
        </tr>
        @endforeach
    </tbody>
</table>
<hr>
合計{{number_format($cart['price'])}}円
<h4>支払方法</h4>
<p>{{$payway[@$Request['payway']]}}</p>
<hr>
<form action="{{ route('purchase') }}" method="post">
    {{ csrf_field() }}
    <input type="submit" value="戻る">
</form>
<hr>
<form action="{{ route('purchase_finish') }}" method="post">
    {{ csrf_field() }}
    <input type="submit" value="購入する">
</form>
</p>
@endsection
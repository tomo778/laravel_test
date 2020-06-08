@extends('layout.index')
@section('title', 'お問い合わせ')
@section('description', 'description')
@section('body')
{{ csrf_field() }}
<h5>お届け先</h5>
〒{{$address['zip1']}}-{{$address['zip2']}}<br>
{{$address['PrefText']}}
{{$address['address1']}} {{$address['address2']}}
<h5>購入商品</h5>
<table class="table">
    <tbody>
        @foreach($cart['items'] as $k => $v)
        <tr>
            @if (empty($v['file_name']))
            <td><img src="{{Config::get('const.noimg_path')}}" alt="dummy" width="100"></td>
            @else
            <td><img src="{{Config::get('const.storage_thumbnail_path')}}{{@$v['file_name']}}?{{@$v['updated_at']}}" alt="dummy" width="100"></td>
            @endif
            <td>{{$v['title']}}</td>
            <td>{{number_format($v['price'])}}円</td>
            <td>{{$v['quantity']}}個</td>
        </tr>
        @endforeach
    </tbody>
</table>
<hr>
合計{{number_format($cart['price'])}}円
<h5>支払方法</h5>
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
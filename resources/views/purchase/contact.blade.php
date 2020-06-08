@extends('layout.index')
@section('title', 'お問い合わせ')
@section('description', 'description')
@section('body')
<h4>購入手続き</h4>
<h5>送り先</h5>
<form action="{{ route('purchase_confirm') }}" method="post">
    {{ csrf_field() }}
    @if ($data->isEmpty())
    <p>送り先住所を登録してください。</p>
    <p>送り先住所の追加は<a href="{{ route('mypage_create')}}">こちらから</a></p>
    <hr>
    @elseif ($data->count() == 1)
    <div>
        〒{{$data[0]['zip1']}}-{{$data[0]['zip2']}}<br>
        {{$data[0]['PrefText']}}
        {{$data[0]['address1']}} {{$data[0]['address2']}}
    </div>
    <input type="hidden" name="address" value="{{$data[0]['id']}}">
    <br>
    <p>別の送り先の追加は<a href="{{ route('mypage_create')}}">こちらから</a></p>
    <hr>
    @else
    <p>送り先住所を選択してください。</p>
    <p>送り先住所の追加は<a href="{{ route('mypage_create')}}">こちらから</a></p>
    <br>
    <table class="table">
        @foreach (@$data as $k => $v)
        <tr>
            <th width="50">
                <input type="radio" name="address" id="{{$v['id']}}" value="{{$v['id']}}" @if (@$Request['address']==$v['id']) checked="checked" @endif>
            </th>
            <td>
                <label for="{{$v['id']}}">
                〒{{$v['zip1']}}-{{$v['zip2']}}<br>
                {{Config::get('const.pref.' . $v['pref'])}}
                {{$v['address1']}} {{$v['address2']}}
                </label>
            </td>
        </tr>
        @endforeach
    </table>
    @endif
    @if($errors->has('address'))<div class="err">{{ $errors->first('address') }}</div class="">@endif
    <h5>支払方法</h5>
    <select name="payway">
        @foreach (Config::get('const.payway') as $k => $v)
        <option value="{{$k}}" @if (@$Request['payway']==$k) selected @endif>{{$v}}</option>
        @endforeach
    </select>
    <hr>
    <input type="submit" value="確認画面へ">
</form>
@endsection
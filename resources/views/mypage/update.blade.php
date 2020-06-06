@extends('layout.index')
@section('title', 'mypageu')
@section('description', 'description')
@section('body')
@isset($data['id'])
<h3>user情報更新</h3>
@else
<h3>user情報登録</h3>
@endif
<form action="{{ route('mypage_update_exe') }}" method="post">
<input type="hidden" name="id" value="{{ old('id', $data['id'])}}">
    {{ csrf_field() }}
    <table class="table">
        <tr>
            <th>郵便番号</th>
            <td>
                <input type="text" name="zip1" value="{{ old('zip1', $data['zip1'])}}" size="10">
                -
                <input type="text" name="zip2" value="{{ old('zip2', $data['zip2'])}}" size="10">
                @if($errors->has('zip1'))<div class="err">{{ $errors->first('zip1') }}</div class="">@endif
                @if($errors->has('zip2'))<div class="err">{{ $errors->first('zip2') }}</div class="">@endif
            </td>
        </tr>
        <tr>
            <th>都道府県</th>
            <td>
                <select name="pref">
                    @foreach (Config::get('const.pref') as $k2 => $v2)
                    <option value="{{$k2}}" @if (old('pref', $data['pref']) == $k2) selected @endif>{{$v2}}</option>
                    @endforeach
                </select>
                @if($errors->has('pref'))<div class="err">{{ $errors->first('pref') }}</div class="">@endif
            </td>
        </tr>
        <tr>
            <th>住所1</th>
            <td>
                <input type="text" name="address1" value="{{ old('address1', $data['address1'])}}" size="40">
                @if($errors->has('address1'))<div class="err">{{ $errors->first('address1') }}</div class="">@endif
            </td>
        </tr>
        <tr>
            <th>住所2</th>
            <td>
                <input type="text" name="address2" value="{{ old('address2', $data['address2'])}}" size="40">
                @if($errors->has('address2'))<div class="err">{{ $errors->first('address2') }}</div class="">@endif
            </td>
        </tr>
    </table>
    <button>更新</button>
</form>
@endsection
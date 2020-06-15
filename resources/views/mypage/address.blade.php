@extends('layout.index')
@section('title', 'mypageu')
@section('description', 'description')
@section('body')
<h3>住所一覧</h3>
@if ($data->isEmpty())
<p><a href="{{ route('mypage_create')}}" class="btn btn-primary">住所登録</a></p>
<br>
@else
<p><a href="{{ route('mypage_create')}}" class="btn btn-primary">住所追加</a></p>
<br>
@foreach (@$data as $k => $v)
<table class="table">
    <tr>
        <th width="100"><a href="{{ route('mypage_update', ['id' => $v['id']]) }}">更新</a></th>
        <td>
            〒{{$v['zip1']}}-{{$v['zip2']}}<br>
            {{$v['PrefText']}}<br>
            {{$v['address1']}} {{$v['address2']}}
        </td>
    </tr>
</table>
@endforeach
@endif
@endsection
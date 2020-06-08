@extends('layout.index')
@section('title', 'mypageu')
@section('description', 'description')
@section('body')
<h3>購入履歴</h3>
@if ($data->isEmpty())
<p>購入履歴はありません。</p>
@else
@foreach (@$data as $k => $v)
<table class="table">
    <tr>
        <th colspan="3">
            ID: {{$k}}
            <br>
            購入日: {{$v[0]['createdAtJa']}}
        </th>
    </tr>
    @foreach (@$v as $k2 => $v2)
    <tr>
        <td>
            {{$v2['title']}}
        </td>
        <td>
            {{$v2['price']}}円
        </td>
        <td width="100">
            数量: {{$v2['quantity']}}
        </td>
    </tr>
    @endforeach
</table>
<hr>
<br>
@endforeach
@endif
@endsection
@extends('layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')
<article>
    <h2 class="blog-post-title">{{$result['title']}}</h2>
    @foreach (@$categorys as $k2 => $v2)
    <span class="plist"><a href="{{ route('category', ['id' => $v2['category_id']]) }}">{{$v2->title}}</a></span>
    @endforeach
    <hr>
    @if (empty($result['file_name']))
    <img src="{{Config::get('const.noimg_path')}}">
    @else
    <img src="{{Config::get('const.storage_path')}}{{@$result['file_name']}}?{{@$result['updated_at']}}">
    @endif
    <hr>
    <p>{!! nl2br(e($result['text'])) !!}</p>
    <hr>
    <p>価格：{{number_format($result['price'])}}円</p>
    <hr>
    <form action="{{route('cart')}}" method="post">
        {{ csrf_field() }}
        数量を選択
        <select name="quantity">
            @foreach (Config::get('const.quantity') as $k => $v)
            <option value="{{$k}}" @if (@$Request['quantity']==$k) selected @endif>{{$v}}</option>
            @endforeach
        </select>
        <hr>
        <input type="hidden" name="item_id" value="{{$result['id']}}" size="40">
        <input type="submit" value="カートに追加">
    </form>
</article>
@endsection
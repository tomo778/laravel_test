@if (isset($bc))
<div id="siteNavi"><a href="/">トップページ</a>
@endif

@if (isset($bc['category_1']))
＞ {{$bc['category_1']}}
@endif

@if (isset($bc['detail_1']))
＞ <a href="{{ route('category', ['id' => $bc['detail_1']['category_id']]) }}">{{$bc['detail_1']['title']}}</a>
@endif
@if (isset($bc['detail_2']))
＞ {{$bc['detail_2']}}
@endif

@if (isset($bc['cart_1']))
＞ {{$bc['cart_1']}}
@endif

@if (isset($bc['contact_1']))
＞ {{$bc['contact_1']}}
@endif

@if (isset($bc))
</div>
@endif
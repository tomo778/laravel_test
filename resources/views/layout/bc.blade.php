@if (!empty($Breadcrumbs))
    <div id="siteNavi"><a href="{{ route('index') }}">トップ</a>
    @foreach($Breadcrumbs as $k => $v)
        @if(empty($k))
        &nbsp＞&nbsp{{$v}}
        @else
        &nbsp＞&nbsp<a href="{{$k}}">{{$v}}</a>
        @endif
    @endforeach
    </div>
@endif
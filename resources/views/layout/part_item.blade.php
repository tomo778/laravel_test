<article class="blog">
    <div class="thumb">
        <a href="{{ route('product', ['id' => $v['id']]) }}">
            @if (empty($v['file_name']))
            <img src="{{Config::get('const.noimg_path')}}" alt="dummy" width="100">
            @else
            <img src="/storage/thumbnail/{{@$v['file_name']}}?{{@$v['updated_at']}}" alt="dummy" width="100">
            @endif
        </a>
    </div>
    <div class="bbox">
        <div class="title"><a href="{{ route('product', ['id' => $v['id']]) }}">{{$v['title']}}</a></div>
        <div class="body">{{number_format($v['price'])}}円</div>
        @foreach ($v['category'] as $k2 => $v2)
        <span class=""><a href="{{ route('category', ['id' => $v2['category_id']]) }}">{{$v2['title']}}</a></span>
        @endforeach
        <div class="info">
            <time>{{@$v['created_at_format']}}</time>
        </div>
    </div>
</article>
<div id="menu">
    <nav>
        <div class="menuitem">
            @auth
            <h4>user情報</h4>
            <div class="menubox">
                {{ Auth::user()->name }}さん
            </div>
            @endauth
            <h4>メニュー</h4>
            <div class="menubox menulist">
                <ul id="menu1">
                    @foreach ($side_categorys as $k => $v)
                    <li><a href="{{ route('category', ['id' => $v->id]) }}">{{$v->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
</div>
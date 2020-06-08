<div id="menu">
    <nav>
        <div class="menuitem">
            <h4>mypageメニュー</h4>
            <div class="menubox menulist">
                <ul id="menu1">
                    <li><a href="{{ route('mypage')}}">top</a></li>
                    <li><a href="{{ route('mypage_address')}}">住所情報</a></li>
                    <li><a href="{{ route('mypage_history')}}">購入履歴</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
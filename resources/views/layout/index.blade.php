<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
	<meta charset="uft-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{{Config::get('const.site_name')}}</title>
	<!-- body タグの最後に足す-->
	<link rel="stylesheet" href="{{ mix('/style/app.css') }}">
	<meta name="keywords" content="aaa" />
	<meta name="description" content="bbb" />
</head>

<body>
	<div id="wrapper">
		<header>
			<div id="top">
				<div class="inner">
					<h1><a href="/">{{Config::get('const.site_name')}}</a></h1>
					<input id="panelsearch" type="radio" name="panel">
					<label for="panelsearch" id="searchbtn"><span>検索ボタン</span></label>

					<input id="panelmenu" type="radio" name="panel">
					<label for="panelmenu" id="topmenubtn"><span>MENU</span></label>
					<nav id="topmenu">
						<ul>
							@guest
							<li><a href="{{ route('login') }}">ログイン</a></li>
							<li><a href="{{ route('register') }}">user登録</a></li>
							@else
							<li><a href="{{ route('mypage') }}">mypage</a></li>
							@endguest
							<li><a href="{{ route('cart') }}">カート</a></li>
							<li><a href="{{ route('contact') }}">お問い合わせ</a></li>
						</ul>
					</nav>
					<input id="panelclose" type="radio" checked="checked" name="panel">
					<label for="panelclose" id="closebtn"><span>閉じる</span></label>
				</div>
			</div>
			@include('layout.bc')
		</header>
		<div id="column2">
			<div id="contents" data-sticky-container>
				<div id="layoutbox" data-sticky-container>
					<div id="main">
						@yield('body')
					</div>
					@isset($mypage)
					@include('layout.sidenav_mypage')
					@else
					@include('layout.sidenav')
					@endisset
				</div>
			</div>
		</div>
		<div id="pagetop"><a href="#wrapper">このページの先頭へ戻る</a></div>

		<footer id="footer">
			<div class="inner">
				<small>Copyright &copy; 2020 {{Config::get('const.site_name')}} All Rights Reserved</small>
			</div>
		</footer>
	</div>
	@yield('script')
</body>

</html>
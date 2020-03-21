<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
	<meta charset="uft-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>{{Config::get('const.site_name')}}</title>
	<!-- body タグの最後に足す-->
	<link rel="stylesheet" href="{{ asset('/css/app.css') }}"/>
	<link rel="stylesheet" href="{{ asset('/css/styles.css') }}"/>
	<meta name="keywords" content="aaa" />
	<meta name="description" content="bbb" />
	<link rel="alternate" type="application/rss+xml" title="RSS" href="rss.xml" />
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
							@foreach ($side_categorys as $k => $v)
							<li><a href="/category/{{$v->id}}">{{$v->title}}</a></li>
							@endforeach
							<li><a href="/cart/">カート</a></li>
							<li><a href="/contact/">お問い合わせ</a></li>
						</ul>
					</nav>
					<input id="panelclose" type="radio" checked="checked" name="panel">
					<label for="panelclose" id="closebtn"><span>閉じる</span></label>
				</div>
			</div>
			@if (isset($bc))
			<div id="siteNavi"><a href="/">トップページ</a>
				@if (isset($bc['category_name']))
				＞ カテゴリ（{{$bc['category_name']}}）</div>
			@endif
			@if (isset($bc['detail_id']))
			＞ {{$result['title']}}
	</div>
	@endif
	@endif
	</header>
	<div id="column2">
		<div id="contents" data-sticky-container>
			<div id="layoutbox" data-sticky-container>
				<div id="main">
					@yield('body')
				</div>
				<div id="menu">
					<nav>
						<div class="menuitem">
							<h4>メニュー</h4>
							<div class="menubox menulist">
								<ul id="menu1">
									@foreach ($side_categorys as $k => $v)
									<li><a href="/category/{{$v->id}}">{{$v->title}}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div id="pagetop"><a href="#wrapper">このページの先頭へ戻る</a></div>

	<footer id="footer">
		<div class="inner">
			<!-- <span><a href="/">ffff</a></span>
				<span><a href="./sitemap.html">サイトマップ</a></span> -->
			<small>Copyright &copy; 2020 {{Config::get('const.site_name')}} All Rights Reserved</small>
		</div>
	</footer>

	</div>
	<!-- <script src="/js/sticky.min.js" defer></script>
	<script src="/js/move_to.min.js" defer></script>
	<script src="/js/ofi.min.js"></script> -->
</body>

</html>
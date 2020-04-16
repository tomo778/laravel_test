<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<title>管理画面 - {{ request()->path() }}</title>
	<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
	<link rel="stylesheet" href="{{asset('/css/alerts-css.min.css')}}" />
	<link rel="stylesheet" href="{{asset('/css/common.css')}}" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
	<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/" target="_blank">管理画面</a>
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="{{route('admin_logout')}}">ログアウト</a>
			</li>
		</ul>
	</nav>

	<div class="container-fluid mb-5">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
				@foreach (Config::get('const.admin_side_nav') as $k => $v)
					@if (!empty(@$v['role']) && @$v['role'] != session("staff_data.role"))
					@continue
					@endif
					<h6 class="d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
						{{ $v['ja'] }}
					</h6>
					<ul class="nav flex-column mb-2">
						@foreach ($v['link'] as $k2 => $v2)
						<li class="nav-item">
							<a class="nav-link active" href="{{ $v2 }}">
								{{ $k2 }}
							</a>
						</li>
						@endforeach
					</ul>
					<hr>
				@endforeach
				</div>
			</nav>
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h2 class="h2">{{ request()->path() }}</h2>
				</div>
				@yield('body')
			</main>
		</div>
	</div>
	<script src=" {{ mix('js/app.js') }} "></script>
	<script src="{{asset('/js/alerts.js')}}"></script>
	<script src="{{asset('/js/common.js')}}"></script>
</body>
</html>

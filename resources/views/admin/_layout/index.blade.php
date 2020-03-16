<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<title>Dashboard Template · Bootstrap</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!-- body タグの最後に足す-->
	<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
	<link rel="stylesheet" href="{{asset('/css/alerts-css.min.css')}}" />
	<link rel="stylesheet" href="{{asset('/css/common.css')}}" />
</head>
<body>
	<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/" target="_blank">test site</a>
		<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="/admin/logout/">Sign out</a>
			</li>
		</ul>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
				@foreach (Config::get('const.admin_side_nav') as $k => $v)
					@if (!empty(@$v['role']) && @$v['role'] != session("staff_data.role"))
					@continue
					@endif
					<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
						<span><i class="fas fa-bars"></i> {{ $v['ja'] }}</span>
						<a class="d-flex align-items-center text-muted" href="#">
							<span data-feather="plus-circle"></span>
						</a>
					</h6>
					<ul class="nav flex-column mb-2">
						@foreach ($v['link'] as $k2 => $v2)
						<li class="nav-item">
							<a class="nav-link active" href="{{ $v2 }}">
								<span data-feather="file-text"></span>
								{{ $k2 }}
							</a>
						</li>
						@endforeach
					</ul>
				@endforeach
				</div>
			</nav>

			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2">モード</h1>
					<div class="btn-toolbar mb-2 mb-md-0">
						<div class="btn-group mr-2">
							<button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
							<button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
						</div>
						<button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
							<span data-feather="calendar"></span>
							This week
						</button>
					</div>
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

@if (session('one_time_mes') == 2 || @$update == 1)
<div class="fixed-alerts fixed-alerts_top fixed-alerts_left">
  <div class="alert alert_info alert_none alert-fade" id="alert-top-left" data-fade-time="3">
	<div class="alert--icon">
	  <i class="fas fa-check-circle"></i>
	</div>
	<div class="alert--content">
	 更新しました!
	</div>
  </div>
</div>
@endif
@if (session('one_time_mes') == 1)
<div class="fixed-alerts fixed-alerts_top fixed-alerts_left">
	<div class="alert alert_success alert_none alert-fade" id="alert-top-left" data-fade-time="3">
	<div class="alert--icon">
	  <i class="fas fa-check-circle"></i>
	</div>
	<div class="alert--content">
	登録しました!
	</div>
  </div>
</div>
@endif

<!-- ajaxの時使用 -->
<!-- <div class="fixed-alerts fixed-alerts_top fixed-alerts_left">
  <div class="alert alert_danger alert_none alert-fade" id="alert_danger" data-fade-time="3">
    <div class="alert--icon">
      <i class="fas fa-check-circle"></i>
    </div>
    <div class="alert--content">
      エラー箇所があります。
    </div>
  </div>
</div> -->

<form method="post" action="">
    @if (@!$result['id'])
    <input type="hidden" name="created_at" value="{!! date('Y-m-d H:i:s') !!}">
    @endif
    <input type="hidden" name="updated_at" value="{!! date('Y-m-d H:i:s') !!}">
	{{ csrf_field() }}

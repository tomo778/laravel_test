@if (session('one_time_mes') == 2 || @$update == 1)
<div class="fixed-alerts fixed-alerts_top fixed-alerts_left">
	<div class="alert alert_info alert_none alert-fade" id="alert-top-left" data-fade-time="3">

		<div class="alert--content">
			更新しました!
		</div>
	</div>
</div>
@endif
@if (session('one_time_mes') == 1)
<div class="fixed-alerts fixed-alerts_top fixed-alerts_left">
	<div class="alert alert_success alert_none alert-fade" id="alert-top-left" data-fade-time="3">
		<div class="alert--content">
			登録しました!
		</div>
	</div>
</div>
@endif
@if (!empty(@$result['id']))
<div class="form-group row">
	<div class="col-sm-10">
		登録日：{{@$result['created_at']}}<br>更新日：{{@$result['updated_at']}}
	</div>
</div>
<hr>
@endif
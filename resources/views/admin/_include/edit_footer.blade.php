@if (!empty($result['id']))
	<div class="form-group row">
		<div class="offset-sm-2 col-sm-10">
			<button class="btn btn-primary edit_btn">更新</button>
		</div>
	</div>
@else
	<div class="form-group row">
		<div class="offset-sm-2 col-sm-10">
			<button class="btn btn-primary edit_btn">登録</button>
		</div>
	</div>
@endif

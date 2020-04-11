<div class="form-group row ">
	<div class="offset-sm-2 col-sm-10">
		@if (!empty($result['id']))
		<button class="btn btn-primary edit_btn">更新</button>
		@else
		<button class="btn btn-primary edit_btn">登録</button>
		@endif
		<button class="btn btn-primary d-none loading" type="button" disabled>
			<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
			Loading...
		</button>
	</div>
</div>
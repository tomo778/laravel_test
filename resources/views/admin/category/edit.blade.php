@extends('admin._layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')

@include('admin._include.edit_header')
	
	@if (!empty($result['id']))
	<div class="form-group row">
		<label for="inputEmail" class="col-sm-2 col-form-label">id</label>
		<div class="col-sm-10">
			{{@$result['id']}}
		</div>
	</div>
	<input type="hidden" class="form-control" name="id" value="{{@$result['id']}}">
	@endif

	<div class="form-group row">
		<label for="inputEmail" class="col-sm-2 col-form-label">タイトル</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="title" value="{{@$result['title']}}">
			<div class="text-danger" data-errmes="title"></div>
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail" class="col-sm-2 col-form-label">内容</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="text" value="{{@$result['text']}}">
			<div class="text-danger" data-errmes="text"></div>
		</div>
	</div>

	@include('admin._include.edit_footer')

</form>

@endsection
@extends('admin._layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')

@include('admin._include.edit_header')
<form method="post" action="{{ request()->fullUrl() }}" name="{{ route('admin_val_product') }}" enctype="multipart/form-data">
	{{ csrf_field() }}

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
		<label for="inputEmail" class="col-sm-2 col-form-label">公開状態</label>
		<div class="col-sm-10">
			@foreach (Config('const.status') as $k => $v)
			<label>
				<input type="radio" name="status" value="{{$k}}" @if (@$result['status']==$k) checked @endif>{{$v}}
			</label>
			@endforeach
		</div>
	</div>
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
			<textarea name="text" id="" class="form-control" cols="30" rows="10">{{@$result['text']}}</textarea>

			<div class="text-danger" data-errmes="text"></div>
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail" class="col-sm-2 col-form-label">値段</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="price" value="{{@$result['price']}}">
			<div class="text-danger" data-errmes="price"></div>
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail" class="col-sm-2 col-form-label">個数</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="num" value="{{@$result['num']}}">
			<div class="text-danger" data-errmes="num"></div>
		</div>
	</div>

	<div class="form-group row">
		<label for="inputEmail" class="col-sm-2 col-form-label">画像</label>
		<div class="col-sm-10">
			<div class="custom-file">
				<input type="hidden" name="file_name" value="{{@$result['file_name']}}">
				<input type="file" id="file_01" name="file_data" class="custom-file-input" id="customFile">
				<label class="custom-file-label" for="customFile">{{@$result['file_name']}}</label>
			</div>
			<div class="text-danger" data-errmes="file_name"></div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script>
		$(function() {
			$('#file_01').on('change', function() {
				$('.custom-file-label').text($(this).prop('files')[0].name);
				$('[name=file_name]').val($(this).prop('files')[0].name);
			});
		});
	</script>
	<div class="form-group row">
		<label for="inputEmail" class="col-sm-2 col-form-label">カテゴリ</label>
		<div class="col-sm-10">
			@foreach ($category as $k => $v)
			<label>
				<input type="checkbox" name="category[]" value="{{$v['id']}}" @if (@isset($result['category'][$v['id']])) checked @endif>{{$v['title']}}
			</label>
			@endforeach
			<div class="text-danger" data-errmes="category"></div>

		</div>
	</div>
	@include('admin._include.edit_footer')
</form>
@endsection
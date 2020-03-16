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
		<label for="inputEmail" class="col-sm-2 col-form-label">公開状態</label>
		<div class="col-sm-10">
			@foreach (Config('const.status') as $k => $v)
			<label>
		      <input type="radio" name="status" value="{{$k}}" @if (@$result['status'] == $k) checked @endif>{{$v}}
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
		<label for="inputEmail" class="col-sm-2 col-form-label">カテゴリ</label>
		<div class="col-sm-10">
			@foreach ($category as $k => $v)
			<label>
		      <input type="checkbox" name="category[]" value="{{$v['id']}}" @if (@in_array((string)$v['id'], $result['category'], true)) checked @endif>{{$v['title']}}
		    </label>
			@endforeach
		</div>
	</div>
@include('admin._include.edit_footer')

</form>

@endsection

@extends('admin._layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')

@include('admin._include.edit_header')
<input type="hidden" name="val" value="{{ route('admin_val_staff') }}">
@if (!empty(@$result['id']))
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
	<label for="inputEmail" class="col-sm-2 col-form-label">ロール</label>
	<div class="col-sm-10">
		@if (@$result['id'] != '1')
		@foreach (Config('const.role') as $k => $v)
		<label>
			<input type="radio" name="role" value="{{$k}}" @if (@$result['role']==$k) checked @endif>{{$v}}
		</label>
		@endforeach
		@else
		管理者
		@endif
	</div>
</div>
<div class="form-group row">
	<label for="inputEmail" class="col-sm-2 col-form-label">名前</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" name="name" value="{{@$result['name']}}">
		<div class="text-danger" data-errmes="name"></div>
	</div>
</div>
<div class="form-group row">
	<label for="inputEmail" class="col-sm-2 col-form-label">email</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" name="email" value="{{@$result['email']}}">
		<div class="text-danger" data-errmes="email"></div>
	</div>
</div>
<div class="form-group row">
	<label for="inputEmail" class="col-sm-2 col-form-label">パスワード</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" name="password" value="">
		@if (!empty(@$result['id']))
		<p class="text-info">※変更する場合のみ記入</p>
		@endif
		<div class="text-danger" data-errmes="password"></div>
	</div>
</div>
@include('admin._include.edit_footer')

</form>

@endsection
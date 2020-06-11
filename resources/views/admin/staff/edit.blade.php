@extends('admin._layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')

@include('admin._include.edit_header')
<form method="post" action="{{ request()->fullUrl() }}" name="{{ route('admin_val_staff') }}">
{{ csrf_field() }}

@if (!empty(@$detail['id']))
<div class="form-group row">
	<label for="inputEmail" class="col-sm-2 col-form-label">id</label>
	<div class="col-sm-10">
		{{@$detail['id']}}
	</div>
</div>
<input type="hidden" class="form-control" name="id" value="{{@$detail['id']}}">
@endif

<!-- <div class="form-group row">
	<label for="inputEmail" class="col-sm-2 col-form-label">公開状態</label>
	<div class="col-sm-10">
		@foreach (Config('const.status') as $k => $v)
		<label>
			<input type="radio" name="status" value="{{$k}}" @if (@$detail['status']==$k) checked @endif>{{$v}}
		</label>
		@endforeach
	</div>
</div> -->
<!-- <div class="form-group row">
	<label for="inputEmail" class="col-sm-2 col-form-label">ロール</label>
	<div class="col-sm-10">
		@if (@$detail['id'] != '1')
		@foreach (Config('const.role') as $k => $v)
		<label>
			<input type="radio" name="role" value="{{$k}}" @if (@$detail['role']==$k) checked @endif>{{$v}}
		</label>
		@endforeach
		@else
		管理者
		@endif
	</div>
</div> -->
<div class="form-group row">
	<label for="inputEmail" class="col-sm-2 col-form-label">名前</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" name="name" value="{{@$detail['name']}}">
		<div class="text-danger" data-errmes="name"></div>
	</div>
</div>
<div class="form-group row">
	<label for="inputEmail" class="col-sm-2 col-form-label">email</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" name="email" value="{{@$detail['email']}}">
		<div class="text-danger" data-errmes="email"></div>
	</div>
</div>
<div class="form-group row">
	<label for="inputEmail" class="col-sm-2 col-form-label">パスワード</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" name="password" value="">
		@if (!empty(@$detail['id']))
		<p class="text-info">※変更する場合のみ記入</p>
		@endif
		<div class="text-danger" data-errmes="password"></div>
	</div>
</div>
@include('admin._include.edit_footer')

</form>

@endsection
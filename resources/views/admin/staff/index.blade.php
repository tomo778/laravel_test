@extends('admin._layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')
<div class="table-responsive">
	{{ $result->links('pagination::bootstrap-4') }}
	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th style="width: 40px">id</th>
				<th style="width: 60px">更新</th>
				<th style="width: 40px">状態</th>
				<th>名前</th>
				<th>email</th>
				<th>ロール</th>
				<th style="width: 100px">作成者</th>
				<th style="width: 100px">更新者</th>
				<th style="width: 120px">作成日</th>
				<th style="width: 120px">更新日</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($result as $k => $v)
			<tr>
				<td>{{$v['id']}}</td>
				<td><a href="{{route('admin_create_staff')}}/{{$v['id']}}">編集</a></td>
				<td>
					@if ($v['status'] != Config('const.status.0'))
					<span class="badge badge-info">{{Config('const.status')[$v['status']]}}</span>
					@else
					<span class="badge badge-danger">{{Config('const.status')[$v['status']]}}</span>
					@endif
				</td>
				<td>{{$v['name']}}</td>
				<td>{{$v['email']}}</td>
				<td>{{Config('const.role')[$v['role']]}}</td>
				<td>{{session('admin_datas_staffs')[$v['created']]}}</td>
				<td>{{session('admin_datas_staffs')[$v['updated']]}}</td>
				<td>{{$v['created_at']}}</td>
				<td>{{$v['updated_at']}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{ $result->links('pagination::bootstrap-4') }}
</div>
@endsection
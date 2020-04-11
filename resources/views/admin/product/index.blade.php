@extends('admin._layout.index')
@section('title', 'ページタイトル')
@section('description', '')
@section('body')
<div class="table-responsive">

	{{ $result->links('pagination::bootstrap-4') }}

	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th style="width: 40px">id</th>

				<!-- <th style="width: 40px"><input type="checkbox"
		value="all"
		v-model="checkedNames"
    v-on:click="selectAll"></th> -->
				<th style="width: 60px">更新</th>
				<th style="width: 40px">状態</th>
				<th>商品名</th>
				<th>商品画像</th>
				<th>説明</th>
				<th>価格</th>
				<th>個数</th>
				<th style="width: 120px">作成日</th>
				<th style="width: 120px">更新日</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($result as $k => $v)
			<tr>
				<td>{{$v['id']}}</td>
				<!-- <td><input type="checkbox" v-model="checkedNames"></td> -->
				<td><a href="{{route('admin_create_product')}}/{{$v['id']}}">編集</a></td>
				<td>
					@if ($v['status'] != Config('const.status.0'))
					<span class="badge badge-info">{{Config('const.status')[$v['status']]}}</span>
					@else
					<span class="badge badge-danger">{{Config('const.status')[$v['status']]}}</span>
					@endif
				</td>
				<td>{{ str_limit($v['title'], $limit = 30, $end = '...') }}</td>
				<td><img src="{{Config::get('const.storage_thumbnail_path')}}{{@$v['file_name']}}?{{@$v['updated_at']}}" alt="dummy" width="100"></td>
				<td>{{ str_limit($v['text'], $limit = 100, $end = '...') }}</td>
				<td>{{$v['price']}}</td>
				<td>{{$v['num']}}</td>
				<td>{{$v['created_at']}}</td>
				<td>{{$v['updated_at']}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $result->links('pagination::bootstrap-4') }}

</div>
@endsection
@extends('admin._layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')
<div class="table-responsive">

	{{ $result->links('pagination::bootstrap-4') }}

	<a v-on:click="fetchTodos(1)">@{{ status[1] }}</a>
	<span> | </span>
	<a v-on:click="fetchTodos(0)">@{{ status[0] }}</a>

  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th style="width: 40px"><input type="checkbox"
		value="all"
		v-model="checkedNames"
		v-on:click="selectAll"></th>
        <th style="width: 40px">id</th>
        <th style="width: 40px">状態</th>
        <th>title</th>
        <th>text</th>
        <th>カテゴリ</th>
        <th style="width: 120px">作成日</th>
        <th style="width: 120px">更新日</th>
        <th style="width: 60px">更新</th>
      </tr>
    </thead>
    <tbody>
	@foreach ($result as $k => $v)
      <tr>
        <td><input type="checkbox" v-model="checkedNames"></td>
        <td>{{$v['id']}}</td>
        <td>
			@if ($v['status'] != Config('const.status.0'))
			<span class="badge badge-info">{{Config('const.status')[$v['status']]}}</span>
			@else
			<span class="badge badge-danger">{{Config('const.status')[$v['status']]}}</span>
			@endif
		</td>
        <td>{{$v['title']}}</td>
        <td>{{$v['text']}}</td>
        <td>{{$v['category']}}</td>
        <td>{{$v['created_at']}}</td>
        <td>{{$v['updated_at']}}</td>
        <td><a href="/admin/news/edit/{{$v['id']}}">編集</a></td>
      </tr>
	  @endforeach
    </tbody>
  </table>

  {{ $result->links('pagination::bootstrap-4') }}

</div>
@endsection

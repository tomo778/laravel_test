@extends('admin.layout.index')
@section('title', 'ページタイトル')
@section('description', 'description')
@section('body')
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function () {
		UIkit.util.on('#sortable1', 'stop', function () {
			var children = $(this).children().find('input');
			children.each(function(k,v) {
				var id = $(v).attr('id');
				$('#' + id).val(k+1);
			});
		});
	});
</script>
@include('admin.include.edit_header')
<div id="sortable1" class="uk-nav uk-nav-default uk-width-large" uk-sortable="cls-custom: uk-box-shadow-small uk-flex uk-flex-middle uk-background">
	@foreach ($result as $k => $v)
		<dl>
			<dt class="uk-text-bold">{{@$v['title']}}</dt>
			<dd>{{@$v['text']}}<input type="hidden" name="sort_num[{{@$v['id']}}]" id="{{@$v['id']}}" value="{{@$k+1}}"></dd>
		</dl>
	@endforeach
</div>
<div class="offset-sm-2 col-sm-10">
	<button type="submit" class="uk-button uk-button-default">更新</button>
</div>
</fieldset>
</form>
@endsection

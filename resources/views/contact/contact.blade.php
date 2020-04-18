@extends('layout.index')
@section('title', 'お問い合わせ')
@section('description', 'description')
@section('body')
<h2>お問い合わせ</h2>
<form action="{{ route('contact_confirm') }}" method="post">
{{ csrf_field() }}
    <p>
        名前：<br>
        <input type="text" name="name" value="{{ old('name' , @$Request['name'] ) }}" size="40">
        <br>
        <div class="err">{{@$errors->first('name')}}</div>
    </p>
    <hr>
    <p>
        ご感想：<br>
        <textarea name="kanso" rows="4" cols="40">{{ old('kanso' , @$Request['kanso'] ) }}</textarea>
        <br>
        <div class="err">{{@$errors->first('kanso')}}</div>
    </p>
    <p>
        <input type="submit" value="確認画面へ">
    </p>
</form>
@endsection
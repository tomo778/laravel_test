@extends('layout.index')
@section('title', 'user登録')
@section('description', 'description')
@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">本登録</div>

            <div class="card-body">
                @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    メールが送信されました。
                </div>
                @endif

                メールを送信しました。メールからメールアドレスの認証をお願いします。<br>
                メールが届いていない場合は、<a href="{{ route('verification.resend') }}">ここをクリックしてください</a>。再送いたします。
            </div>
        </div>
    </div>
</div>
@endsection
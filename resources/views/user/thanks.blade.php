@extends('layouts.app_user')
@section('title', '予約情報送信完了')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <form method="POST" action="{{ route('user.calendar') }}">
        @csrf
        <div class="form-row justify-content-center">
          <div class="col-md-8">
            <ol class="step">
              <li>入力画面</li>
              <li>確認画面</li>
              <li class="is-current">完了画面</li>
            </ol>
          </div>
        </div>
        <div class="form-row justify-content-center text-center pt-4 pb-3">
          <div class="form-group col-md-8">
            診療予約を受け付けました。</br>
            ご登録のメールアドレスにメールを送信しましたのでご確認ください。</br>
          </div>
        </div>
        <div class="form-row justify-content-center text-center">
          <div class="col-md-8">
            <button type="submit" class="btn btn-secondary" name="action" value="submit">
              戻　　る
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
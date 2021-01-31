@extends('layouts.app_user')
@section('title', 'キャンセルURL期限切れ')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <form method="POST" action="{{ route('user.calendar') }}">
        @csrf
        <div class="form-row justify-content-center text-center pt-3 pb-3">
          <div class="col-md-12 pt-4 pb-3">
            キャンセルの受付期限が切れています。<br>
            恐れ入りますが、お電話でキャンセルをお願いいたします。<br>
            Tel： 03-3384-7000
          </div>
        </div>
        <div class="form-row justify-content-center text-center">
          <div class="col-md-12">
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
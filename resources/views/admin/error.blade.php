@extends('layouts.app_admin_calendar')
@section('title', '予約エラー')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <form method="POST" action="{{ route('admin.calendar') }}">
      @csrf
        <div class="form-row justify-content-center text-center pt-3 pb-3">
          <div class="col-md-12 pt-4 pb-3">
            {!! $message !!}
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
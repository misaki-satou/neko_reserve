@extends('layouts.app_admin_calendar')
@section('title', '管理画面TOP') 
@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">管理画面TOP</div>
    <div class="card-body">
      <div>
        <a href="{{ url('admin/calendar') }}" class="btn btn-primary">診療予約カレンダー</a>
      </div>
  
      <form method="post" action="{{ url('admin/logout') }}">
        @csrf
        <input type="submit" class="btn btn-danger" value="ログアウト" />
      </form>
    </div>
  </div>
</div>
@endsection
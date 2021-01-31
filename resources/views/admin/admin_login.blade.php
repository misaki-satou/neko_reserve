@extends('layouts.app_admin_top_calendar')
@section('title', '管理画面ログイン') 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card">
        <div class="neko card-header">管理画面ログイン</div>
        <div class="card-body">  
          @if ($errors->any())
          <div style="color:red;">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif  
          <form method="post" action="{{ url('admin/login') }}">
            @csrf 
            <div>
              ID: <input class="form-control" type="text" name="user_id" value="" />
            </div>
            <div>
              PASS: <input class="form-control" type="password" name="password" value="" />
            </div>
            <div class="mt-3 text-center">
              <input class="btn btn-secondary" type="submit" value="ログイン" />
            </div>
          </form>
        </div>
      </div>
    </div>
  <div>
</div>
@endsection
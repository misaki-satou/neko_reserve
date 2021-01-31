@extends('layouts.app_admin_calendar')
@section('title', '管理画面')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <h1 class="neko">診療予約管理画面</h1>
        <p>
          ※現在予約できる期間：{!! $period !!}<br>
          ※受付開始：30日前の0時から受付を開始します<br>
          ※受付締切：1日前の18時まで受付が可能です<br>
          ※キャンセル受付締切：1日前の18時までキャンセルが可能です<br>
        </p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-12 pt-2">
        <h2 class="neko">診療予約</h2>
        <ul class="series pt-2">
          <li class="series1"><span class="base">予約できます</span></li>
          <li class="series2"><span class="base">予約が入っています</span></li>
          <li class="series3"><span class="base">診療時間外のため予約できません</span></li>
        </ul>
      </div>
    </div>
    <div class="row justify-content-center pb-5">
      <div class="col-md-2">
        <div class="card">
          <div class="neko card-header"><i class="fas fa-th-list">カレンダー</i></div>
            <div class="card-body">
              <div class="panel panel-default">                    
                <ul class="nav nav-pills nav-stacked" style="display:block;">
                  <li><i class="fas fa-user-alt"></i> <a href="#">XXXXXXXX</a></li>
                  <li><i class="fas fa-user-alt"></i> <a href="#">XXXXXXXX</a></li>
                  <li><i class="fas fa-user-alt"></i> <a href="#">XXXXXXXX</a></li>
                </ul>                    
              </div>
            </div>
        </div>
      </div>
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">
            <div id="calendar-container">
              <div id="calendar"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
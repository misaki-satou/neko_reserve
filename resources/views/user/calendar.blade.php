@extends('layouts.app_user_calendar')
@section('title', '診療予約')
@section('content')
  <div class="container">
    <div class="row justify-content-center pb-5">
      <div class="col-md-12">
        <h1 class="neko">診療予約</h1>
        <p>
          「ねこの病院 Tom&Tabby Suginami」の診療予約です。<br>
          静かな個室で丁寧にお話を聞き、猫ちゃんのストレスを最小限に治療を行います。
        </p>
        <p>
          ※現在予約できる期間：{!! $period !!}<br>
          ※受付開始：30日前の0時から受付を開始します<br>
          ※受付締切：1日前の18時まで受付が可能です<br>
          ※キャンセル受付締切：1日前の18時までキャンセルが可能です<br>
          ※当日の診療予約はお電話にてご連絡ください<br>
        </p>
      </div>
      <div class="col-md-12 pt-3 pb-3">
        <h2 class="neko">予約日時を選択してください</h2>
        <ul class="series pt-2">
          <li class="series1"><span class="base">予約できます</span></li>
          <li class="series2"><span class="base">既に予約が入っているため予約できません</span></li>
          <li class="series3"><span class="base">診療時間外のため予約できません</span></li>
        </ul>
      </div>
      <div class="col-md-12">
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
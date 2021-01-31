@extends('layouts.app_admin_calendar')
@section('title', '予約情報更新') 
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="form-row justify-content-center">
          <div class="col-md-8">
            <ol class="step">
              <li class="is-current">予約情報更新</li>
            </ol>
            @if(count($errors) > 0)
            <div class="pt-3">
              <ul>
                @foreach($errors->all() as $error)
                  <li class="text-danger">{{$error}}</li>
                @endforeach
              </ul>
            </div>
            @endif
          </div>
        </div>
        <form method="POST" action="{{ route('admin.send') }}">
          @csrf
          <!--予約日時-->
          <div class="form-row mb-4 mt-4 justify-content-center">
            <div class="col-md-8">
              予約日時：{{ Session::get('entry_date') }}
            </div>
          </div>
          <!--/予約日時-->
          <!--カルテ番号-->
          <div class="form-row mb-4 justify-content-center">
            <div class="form-group col-md-5">
              初診か再診をお選びください
              <div class="form-check">
                <input class="form-check-input js-check" type="radio" id="radio01" name="radio" value='初診' {{ Session::get('radio') == '初診' ? 'checked' : '' }}>
                <label class="form-check-label" for="syoshin">
                初診
                </label>
              </div>
              <div class="form-check pb-2">
                <input class="form-check-input js-check" type="radio" id="radio01" name="radio" value='再診' {{ Session::get('radio') == '再診' ? 'checked' : '' }}>
                再診
                </label>
              </div>
              <span id="sample">
                カルテ番号(例：1111-11)<br>                
                <input type="text" class="form-control" name="medical-record-number" value="{{ Session::get('medical-record-number') }}" size="30"  autocomplete="off">                
              </span>
            </div>
            <div class="col-md-3">
            </div>
            <div class="col-md-8">
              <p class="indent-1">
                ※再診の患者様でカルテ番号がわからない場合、空白のまま登録してください。<br>
                その場合、自動で「わからない」が登録されます。
              </p>
            </div>
          </div>
          <!--/カルテ番号-->
          <!--氏名 ふりがな-->
          <div class="form-row mb-4 justify-content-center">
            <div class="form-group col-md-4">
              <label for="family-name-kana">飼い主様のお名前（姓）フリガナ<span class="badge badge-danger">必須</span></label>
              <input type="text" class="form-control" name="family-name-kana" value="{{ Session::get('family-name-kana') }}" autocomplete="family-name-kana">
            </div>
            <div class="form-group col-md-4">
              <label for="given-name-kana">飼い主様のお名前（名）フリガナ<span class="badge badge-danger">必須</span></label>
              <input type="text" class="form-control" name="given-name-kana" value="{{ Session::get('given-name-kana') }}"  autocomplete="given-name-kana">
            </div>
          </div>
          <!--/氏名　ふりがな-->
          <!--電話番号-->
          <div class="form-row mb-4 justify-content-center">
            <div class="form-group col-md-4">
              <label for="tel">電話番号(ハイフンなし)<span class="badge badge-danger">必須</span></label>
              <input type="tel" class="form-control" name="tel" value="{{ Session::get('tel') }}" autocomplete="tel">
            </div>
            <div class="col-md-4 mb-3">            
            </div>
          </div>
          <!--/電話番号-->
          <!--氏名-->
          <div class="form-row mb-4 justify-content-center">
            <div class="form-group col-md-4">
              <label for="family-name">飼い主様のお名前（姓）</label>
              <input type="text" class="form-control" name="family-name" value="{{ Session::get('family-name') }}" autocomplete="family-name">
            </div>
            <div class="form-group col-md-4">
              <label for="given-name">飼い主様のお名前（名）</label>
              <input type="text" class="form-control" name="given-name" value="{{ Session::get('given-name') }}" autocomplete="given-name">
            </div>
          </div>
          <!--/氏名-->          
          <!--ねこのお名前-->
          <div class="form-row mb-4 justify-content-center">
            <div class="form-group col-md-4">
              <label for="cat-name">ねこのお名前</label>
              <input type="text" class="form-control" name="cat-name" value="{{ Session::get('cat-name') }}">
            </div>
            <div class="col-md-4 mb-3">
            </div>
          </div>
          <!--/ねこのお名前-->
          <!--Eメール-->
          <div class="form-row mb-4 justify-content-center">
            <div class="form-group col-md-8">
              <label for="email">メールアドレス</label>
              <input type="email" class="form-control" name="email" value="{{ Session::get('email') }}" autocomplete="email">
            </div>
          </div>
          <!--/Eメール-->
          <!--ボタンブロック-->
          <div class="form-row justify-content-center text-center">
            <button type="submit" class="btn btn-secondary mr-5" name="action" value="back">
              戻　　る
            </button>
            <button type="submit" class="btn btn-secondary ml-5" name="action" value="submit">
              登　　録
            </button>
          </div>
          <!--/ボタンブロック-->
        </form>
      </div>
    </div>
  </div>
@endsection
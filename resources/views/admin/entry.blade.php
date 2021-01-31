@extends('layouts.app_admin_calendar')
@section('title', '予約新規登録') 
@section('content')
  <div class="container">
    <div class="row">
    <div class="col-12">
      <div class="form-row justify-content-center">
        <div class="col-md-8">
          <ol class="step">
            <li class="is-current">入力画面</li>
            <li>確認画面</li>
            <li>完了画面</li>
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
      <form method="POST" action="{{ route('admin.confirm') }}">
        @csrf
        <!--予約日時-->
        <div class="form-row mb-4 mt-4 justify-content-center">
          <div class="col-md-8">
            <label for="entry_date">予約日時
              <input type="text" class="form-control" name="entry_date_time" value="{{$entry_date_time}}" readonly>
            </label>
          </div>
        </div>
        <!--/予約日時-->
        <!--カルテ番号-->
        <div class="form-row mb-4 justify-content-center">
          <div class="form-group col-md-5">
            初診か再診かをお選びください<span class="badge badge-danger">必須</span>
            <div class="form-check">
              <input class="form-check-input js-check" type="radio" id="radio01" name="radio" value='初診' {{ old('radio') == '初診' ? 'checked' : '' }}>
              <label class="form-check-label" for="syoshin">
              初診
              </label>
            </div>
            <div class="form-check pb-2">
              <input class="form-check-input js-check" type="radio" id="radio01" name="radio" value='再診' {{ old('radio') == '再診' ? 'checked' : '' }}>
              再診
              </label>
            </div>
            <span id="sample">
                <input type="text" class="form-control" name="medical-record-number" value="{{ old('medical-record-number') }}" size="30"  autocomplete="off">
                <!--<div class="form-check">
                  <input class="form-check-input" type="checkbox" id="check1a" name="medical_record_number_check" value="カルテ番号がわからない" {{ old('medical_record_number_check') == 'カルテ番号がわからない' ? 'checked' : '' }}>
                  <label class="form-check-label" for="check1a">カルテ番号がわからない方はチェックしてください</label>
                </div>
              </input>-->
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
            <input type="text" class="form-control" name="family-name-kana" value="{{ old('family-name-kana') }}" autocomplete="family-name-kana">
          </div>
          <div class="form-group col-md-4">
            <label for="given-name-kana">飼い主様のお名前（名）フリガナ<span class="badge badge-danger">必須</span></label>
            <input type="text" class="form-control" name="given-name-kana" value="{{ old('given-name-kana') }}"  autocomplete="given-name-kana">
          </div>
        </div>
        <!--/氏名　ふりがな-->
        <!--電話番号-->
        <div class="form-row mb-4 justify-content-center">
          <div class="form-group col-md-4">
            <label for="tel">電話番号(ハイフンなし)<span class="badge badge-danger">必須</span></label>
            <input type="tel" class="form-control" name="tel" value="{{ old('tel') }}" autocomplete="tel">
          </div>
          <div class="col-md-4 mb-3">            
          </div>
        </div>
        <!--/電話番号-->
        <!--氏名-->
        <div class="form-row mb-4 justify-content-center">
          <div class="form-group col-md-4">
            <label for="family-name">飼い主様のお名前（姓）</label>
            <input type="text" class="form-control" name="family-name" value="{{ old('family-name') }}" autocomplete="family-name">
          </div>
          <div class="form-group col-md-4">
            <label for="given-name">飼い主様のお名前（名）</label>
            <input type="text" class="form-control" name="given-name" value="{{ old('given-name') }}" autocomplete="given-name">
          </div>
        </div>
        <!--/氏名-->        
        <!--ねこのお名前-->
        <div class="form-row mb-4 justify-content-center">
          <div class="form-group col-md-4">
            <label for="cat-name">ねこのお名前</label>
            <input type="text" class="form-control" name="cat-name" value="{{ old('cat-name') }}">
          </div>
          <div class="col-md-4 mb-3">
          </div>
        </div>
        <!--/ねこのお名前-->
        <!--Eメール-->
        <div class="form-row mb-4 justify-content-center">
          <div class="form-group col-md-8">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email">
          </div>
        </div>
        <!--<div class="form-row mb-4 justify-content-center">
          <div class="form-group col-md-8">
            <label for="email-confirm">メールアドレス（確認用）<span class="badge badge-danger">必須</span></label>
            <input type="email" class="form-control" name="email-confirm" value="{{ old('email-confirm') }}">
          </div>
        </div>-->
        <!--/Eメール-->
        
        <!--ボタンブロック-->
        <div class="form-row justify-content-center text-center">
          <button type="submit" class="btn btn-secondary mr-5" name="action" value="back">
            戻　　る
          </button>
          <button type="submit" class="btn btn-secondary ml-5" name="action" value="submit">
            確認へ進む
          </button>
        </div>
        <!--/ボタンブロック-->
      </form>
    </div>
  </div>
</div>
@endsection
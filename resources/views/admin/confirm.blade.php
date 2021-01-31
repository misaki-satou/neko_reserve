@extends('layouts.app_admin_calendar')
@section('title', '予約新規登録確認')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="form-row justify-content-center">
          <div class="col-md-8">
            <ol class="step">
              <li>入力画面</li>
              <li class="is-current">確認画面</li>
              <li>完了画面</li>
            </ol>
          </div>
        </div>
        <form method="POST" action="{{ route('admin.send2') }}">
        @csrf
          <!--予約日時-->
          <div class="form-row mb-4 mt-4 justify-content-center">
            <div class="col-md-8">
              予約日時：{!! $inputs['entry_date_time'] !!}
              <input name="entry_date_time" value="{{ $inputs['entry_date_time'] }}" type="hidden">
            </div>
          </div>
          <!--/予約日時-->
          <div class="row justify-content-center">
            <div class="form-group col-md-8">
              <div class="col-md-12">              
                <table class="table">
                  <thead>
                    <tr>
                      <td>カルテ情報</td>
                      <td>
                        {!! $inputs['radio'] !!}
                        <input name="radio" value="{{ $inputs['radio'] }}" type="hidden">
                      </td>
                    </tr>
                    <tr>
                      <td>カルテ番号</td>
                      <td>
                        {!! $inputs['medical-record-number'] !!}
                        <input name="medical-record-number" value="{{ $inputs['medical-record-number'] }}" type="hidden">
                      </td>
                    </tr>
                    <tr>
                      <td>飼い主様のお名前（姓）フリガナ</td>
                      <td>
                        {!! $inputs['family-name-kana'] !!}
                        <input name="family-name-kana" value="{{ $inputs['family-name-kana'] }}" type="hidden">
                      </td>
                    </tr>
                    <tr>
                      <td>飼い主様のお名前（名）フリガナ</td>
                      <td>
                        {!! $inputs['given-name-kana'] !!}
                        <input name="given-name-kana" value="{{ $inputs['given-name-kana'] }}" type="hidden">
                      </td>
                    </tr>
                    <tr>
                      <td>電話番号</td>
                      <td>
                        {!! $inputs['tel'] !!}
                        <input name="tel" value="{{ $inputs['tel'] }}" type="hidden">
                      </td>
                    </tr>
                    <tr>
                      <td>飼い主様のお名前（姓）</td>
                      <td>
                        {!! $inputs['family-name'] !!}
                        <input name="family-name" value="{{ $inputs['family-name'] }}" type="hidden">
                      </td>
                    </tr>
                    <tr>
                      <td>飼い主様のお名前（名）</td>
                      <td>
                        {!! $inputs['given-name'] !!}
                        <input name="given-name" value="{{ $inputs['given-name'] }}" type="hidden">
                      </td>
                    </tr>
                    <tr>
                      <td>ねこのお名前</td>
                      <td>
                        {!! $inputs['cat-name'] !!}
                        <input name="cat-name" value="{{ $inputs['cat-name'] }}" type="hidden">
                      </td>
                    </tr>
                    <tr>
                      <td>メールアドレス</td>
                      <td>
                        {!! $inputs['email'] !!}
                        <input name="email" value="{{ $inputs['email'] }}" type="hidden">
                      </td>
                    </tr>
                  </thead>
                </table>
                <div class="form-row justify-content-center text-center">
                  <button type="submit" class="btn btn-secondary mr-5" name="action" value="back">
                      入力内容修正
                  </button>
                  <button type="submit" class="btn btn-secondary ml-5" name="action" value="submit">
                      送信する
                  </button>
                </div>
              </div>
            </div>  
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@extends('layouts.app_admin_calendar')
@section('title', '予約情報詳細')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="form-row justify-content-center">
          <div class="col-md-8">
            <ol class="step">
              <li class="is-current">予約情報詳細</li>
            </ol>
          </div>
        </div>
        <form method="POST" action="{{ route('admin.update') }}">
        @csrf
          <!--/予約日時-->
          <div class="row justify-content-center">
            <div class="form-group col-md-8">
              <div class="col-md-12">              
                <table class="table">
                  <thead>
                    <tr>
                      <td>予約日時</td>
                      <td>
                        {{ Session::get('entry_date') }}
                      </td>
                    </tr>

                    <tr>
                      <td>カルテ番号</td>
                      <td>
                        {{ Session::get('medical-record-number') }}
                      </td>
                    </tr>
                    <tr>
                      <td>飼い主様のお名前</td>
                      <td>
                        {{ Session::get('family-name') }} {{ Session::get('given-name') }}
                      </td>
                    </tr>
                    <tr>
                      <td>飼い主様のお名前 フリガナ</td>
                      <td>
                        {{ Session::get('family-name-kana') }} {{ Session::get('given-name-kana') }}                  
                      </td>
                    </tr>
                    <tr>
                      <td>ねこのお名前</td>
                      <td>
                        {{ Session::get('cat-name') }}
                      </td>
                    </tr>
                    <tr>
                      <td>メールアドレス</td>
                      <td>
                        {{ Session::get('email') }}
                      </td>
                    </tr>
                    <tr>
                      <td>電話番号</td>
                      <td>
                        {{ Session::get('tel') }}
                      </td>
                    </tr>
                  </thead>
                </table>                
              </div>
            </div>  
          </div>
          <div class="form-row justify-content-center text-center pt-2">
            <div class="form-group col-md-7">
              <button type="submit" class="btn btn-secondary" name="action" value="back">
                戻　　る
              </button>
              <button type="submit" class="btn btn-secondary mr-5 ml-5" name="action" value="cancel" onClick="delete_alert(event);return false;">
                予約削除
              </button>
              <button type="submit" class="btn btn-secondary" name="action" value="submit">
                編　　集
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
  function delete_alert(e){
     if(!window.confirm('本当に削除しますか？')){
        return false;
     }
     document.actionform.submit();
  };
  </script>
@endsection
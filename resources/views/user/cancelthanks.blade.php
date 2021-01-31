@extends('layouts.app_user')
@section('title', 'キャンセル完了')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      @csrf
      <div class="form-row justify-content-center">
        <div class="col-md-8">
          <ol class="step">
            <li>キャンセル完了</li>
          </ol>
        </div>
      </div>
      <div class="form-row justify-content-center text-center pt-4 pb-3">
        <div class="form-group col-md-8">
          キャンセルを受け付けました。</br>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
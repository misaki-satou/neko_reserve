<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// リソースコントローラー
Route::resource('resource', 'ResourceController');
/*********************
* ユーザー画面
**********************/
//　1.予約日時選択画面（fullcalendar）
Route::get('/user/calendar', 'UserFullCalendarController@calendar')->name('user.calendar');
Route::post('/user/calendar', 'UserFullCalendarController@calendar')->name('user.calendar');
Route::get('/user/getcalendar','UserFullCalendarController@getCalendar');
//　2.予約情報登録画面
Route::get('/user/entry/{info}', 'UserFullCalendarController@entry')->name('user.entry');
//　3.予約情報登録からの予約情報確認画面
Route::post('/user/confirm', 'UserFullCalendarController@confirm')->name('user.confirm');
//　4.予約情報確認画面からの予約送信完了画面
Route::post('/user/thanks', 'UserFullCalendarController@send')->name('user.send');
Route::view('/user/error', '/user/error')->name('user.error');

// 5.キャンセルURLをクリック
Route::get('/user/cancel/{id}', 'UserFullCalendarController@cancel')->name('user.cancel');
// 6.キャンセル画面からのキャンセルボタンクリック
Route::post('/user/cancelthanks', 'UserFullCalendarController@cancelthanks')->name('user.cancelthanks');
// 7.キャンセルURL　期限切れ or 無効URL
Route::get('/user/invalid', 'UserFullCalendarController@invalid')->name('user.invalid');

/*********************
* 管理画面
**********************/
//管理側
Route::group(['middleware' => ['auth.admin']], function () {
  //　1.予約日時選択画面（fullcalendar）
  Route::get('/admin/calendar', 'AdminFullCalendarController@calendar')->name('admin.calendar');
  Route::post('/admin/calendar', 'AdminFullCalendarController@calendar')->name('admin.calendar');
  Route::get('/admin/getcalendar','AdminFullCalendarController@getCalendar');
  // 2.予約情報詳細画面
  Route::get('/admin/details/{id}', 'AdminFullCalendarController@details')->name('admin.details');
  Route::view('/admin/error', '/admin/error')->name('admin.error');
  // 3.予約情報詳細画面からの予約情報更新画面
  Route::post('/admin/update', 'AdminFullCalendarController@update')->name('admin.update');Route::get('/admin/update', 'AdminFullCalendarController@update')->name('admin.update');
  //　4.予約情報編集画面からの予約送信完了画面
  Route::post('/admin/send', 'AdminFullCalendarController@send')->name('admin.send');
  Route::view('/admin/error', '/admin/error')->name('admin.error');
  //　5.予約新規登録画面
  Route::get('/admin/entry/{info}', 'AdminFullCalendarController@entry')->name('admin.entry');
  //　6.予約新規登録画面からの予約新規登録確認画面
  Route::post('/admin/confirm', 'AdminFullCalendarController@confirm')->name('admin.confirm');
  //　7.予約新規登録確認画面からの予約送信完了画面
  Route::post('/admin/thanks', 'AdminFullCalendarController@send2')->name('admin.send2');
  Route::view('/admin/error', '/admin/error')->name('admin.error');
  //ログアウト実行
  Route::post('/admin/logout', 'admin\AdminLogoutController@logout')->name('admin.logout');
  Route::get('/admin/logout', 'admin\AdminLogoutController@logout')->name('admin.logout');
});

//管理側ログイン
Route::get('/admin/login', 'admin\AdminLoginController@showLoginform');
Route::post('/admin/login', 'admin\AdminLoginController@login');

//営業時間設定
Route::get('/holiday_setting', 'HolidaySettingController@form')->name("holiday_setting");
Route::post('/holiday_setting', 'HolidaySettingController@update')->name("update_holiday_setting");
//臨時休業、臨時営業設定
Route::get('/extra_holiday_setting','ExtraHolidaySettingController@form')->name("extra_holiday_setting");
Route::post('/extra_holiday_setting','ExtraHolidaySettingController@update')->name("update_extra_holiday_setting");
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

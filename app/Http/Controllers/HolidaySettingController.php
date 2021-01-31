<?php
  namespace App\Http\Controllers;
  use App\Http\Controllers;
  use Illuminate\Http\Request;
  use App\Models\HolidaySetting;
  
  class HolidaySettingController extends Controller
  {
    
    function form(){
      
      //取得
      //$setting = HolidaySetting::firstOrNew();
      $setting = HolidaySetting::first();
      if(!$setting)$setting = new HolidaySetting();
      
      return view("admin/holiday_setting_form", [
        "setting" => $setting,
        "FLAG_OPEN" => HolidaySetting::OPEN,
        "FLAG_CLOSE" => HolidaySetting::CLOSE
      ]);
    }
    function update(Request $request){
      //取得
      //$setting = HolidaySetting::firstOrNew();
      $setting = HolidaySetting::first();
      //更新
      $setting->update($request->all());
      return redirect()
        ->action("HolidaySettingController@form")
        ->withStatus("保存しました");
    }
  }
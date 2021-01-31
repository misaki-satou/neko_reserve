<?php
  namespace App\Http\Controllers;
  use App\Http\Controllers;
  use Illuminate\Http\Request;
  use App\Calendar\Form\CalendarFormView;
  use App\Models\ExtraHoliday;
  class ExtraHolidaySettingController extends Controller
  {
    public function form(){
      
      $calendar = new CalendarFormView(time());
      
      //logger()->info('$calendar');
      //logger()->info('User failed to login.', ["calendar" => $calendar]);

      return view('admin.extra_holiday_setting_form', [
        "calendar" => $calendar
      ]);
    }
    /*
    public function update(Request $request){
      return redirect()
        ->action("ExtraHolidaySettingController@form")
        ->withStatus("保存しました");
    }
    */
    
    public function update(Request $request){
      $input = $request->get("extra_holiday");
      ExtraHoliday::updateExtraHolidayWithMonth(date("Ym"), $input);      
      return redirect()
        ->action("ExtraHolidaySettingController@form")
        ->withStatus("保存しました");
    }
  }
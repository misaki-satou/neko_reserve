<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Yasumi\Yasumi;
class HolidaySetting extends Model
{
  //営業日定数
  const OPEN = 1;
  const CLOSE = 2;
  
  //モデルと関連しているテーブル
  protected $table = 'm_facilities_opening_hours';
  // テーブルの主キー
  protected $primaryKey = 'facility_opening_hours_id';
  
  protected $guarded = [
    'facility_opening_hours_id',
    'facility_id',
    'facility_start_time_am',
    'facility_end_time_am',
    'facility_start_time_pm',
    'facility_end_time_pm',
    'created_at',
    'updated_at'
  ];
  /*
  protected $fillable = [
    "monday_am",
    "monday_pm",
    "tuesday_am",
    "tuesday_pm",
    "wednesday_am",
    "wednesday_pm",
    "thursday_am",
    "thursday_pm",
    "friday_am",
    "friday_pm",
    "saturday_am",
    "saturday_pm",
    "sunday_am",
    "sunday_pm",
    "holiday_am",
    "holiday_pm",
    //"facility_start_time_am",
    //"facility_end_time_am",
    //"facility_start_time_pm",
    //"facility_end_time_pm",
  ];
  */
  // open
  function isOpenMondayAM(){
    return $this->monday_am == HolidaySetting::OPEN;
  }
  function isOpenMondayPM(){
    return $this->monday_pm == HolidaySetting::OPEN;
  }
  function isOpenTuesdayAM(){
    return $this->tuesday_am == HolidaySetting::OPEN;
  }
  function isOpenTuesdayPM(){
    return $this->tuesday_pm == HolidaySetting::OPEN;
  }
  function isOpenWednesdayAM(){
    return $this->wednesday_am == HolidaySetting::OPEN;
  }
  function isOpenWednesdayPM(){
    return $this->wednesday_pm == HolidaySetting::OPEN;
  }
  function isOpenThursdayAM(){
    return $this->thursday_am == HolidaySetting::OPEN;
  }
  function isOpenThursdayPM(){
    return $this->thursday_pm == HolidaySetting::OPEN;
  }
  function isOpenFridayAM(){
    return $this->friday_am == HolidaySetting::OPEN;
  }
  function isOpenFridayPM(){
    return $this->friday_pm == HolidaySetting::OPEN;
  }
  function isOpenSaturdayAM(){
    return $this->saturday_am == HolidaySetting::OPEN;
  }
  function isOpenSaturdayPM(){
    return $this->saturday_pm == HolidaySetting::OPEN;
  }
  function isOpenSundayAM(){
    return $this->sunday_am == HolidaySetting::OPEN;
  }
  function isOpenSundayPM(){
    return $this->sunday_pm == HolidaySetting::OPEN;
  }
  function isOpenHolidayAM(){
    return $this->holiday_am == HolidaySetting::OPEN;
  }
  function isOpenHolidayPM(){
    return $this->holiday_pm == HolidaySetting::OPEN;
  }
  // close
  function isCloseMondayAM(){
    return $this->monday_am == HolidaySetting::CLOSE;
  }
  function isCloseMondayPM(){
    return $this->monday_pm == HolidaySetting::CLOSE;
  }
  function isCloseTuesdayAM(){
    return $this->tuesday_am == HolidaySetting::CLOSE;
  }
  function isCloseTuesdayPM(){
    return $this->tuesday_pm == HolidaySetting::CLOSE;
  }
  function isCloseWednesdayAM(){
    return $this->wednesday_am == HolidaySetting::CLOSE;
  }
  function isCloseWednesdayPM(){
    return $this->wednesday_pm == HolidaySetting::CLOSE;
  }
  function isCloseThursdayAM(){
    return $this->thursday_am == HolidaySetting::CLOSE;
  }
  function isCloseThursdayPM(){
    return $this->thursday_pm == HolidaySetting::CLOSE;
  }
  function isCloseFridayAM(){
    return $this->friday_am == HolidaySetting::CLOSE;
  }
  function isCloseFridayPM(){
    return $this->friday_pm == HolidaySetting::CLOSE;
  }
  function isCloseSaturdayAM(){
    return $this->saturday_am == HolidaySetting::CLOSE;
  }
  function isCloseSaturdayPM(){
    return $this->saturday_pm == HolidaySetting::CLOSE;
  }
  function isCloseSundayAM(){
    return $this->sunday_am == HolidaySetting::CLOSE;
  }
  function isCloseSundayPM(){
    return $this->sunday_pm == HolidaySetting::CLOSE;
  }
  function isCloseHolidayAM(){
    return $this->holiday_am == HolidaySetting::CLOSE;
  }
  function isCloseHolidayPM(){
    return $this->holiday_pm == HolidaySetting::CLOSE;
  }
  
  private $holidays = null;

  function loadHoliday($year){
    //$this->holidays = Yasumi::create("Japan", $year,"ja_JP");
  }

  function isHoliday($date){
    if(!$this->holidays)return false;
    return $this->holidays->isHoliday($date);
  }
}

<?php
  /*
  * 日を出力するためのクラス
  */
  namespace App\Calendar;
  use Carbon\Carbon;
  use App\Models\HolidaySetting;


  class CalendarWeekDay {
    protected $carbon;
    protected $isHoliday = false;
    protected $isAm = false;
    protected $isPm= false;

    function __construct($date){
      $this->carbon = new Carbon($date);
      
    }
    
    function getClassName(){
      $classNames = [ "day-" . strtolower($this->carbon->format("D")) ];

      //祝日フラグを出す
      if($this->isHoliday){
        $classNames[] = "day-close";
      }

      return implode(" ", $classNames);
    }
    
    function getDateKey(){
      return $this->carbon->format("Ymd");
    }
    
    function setHoliday($flag){
      $this->isHoliday = $flag;
    }

    /**
     * @return 
     */
    function render(){
      return '<p class="day">' . $this->carbon->format("j"). '</p>';
    }
    /**
     * 休みかどうかを判定する
     */
    function checkHoliday(HolidaySetting $setting){
      
      if($this->carbon->isMonday() && $setting->isCloseMondayAM()){
        $this->isHoliday = true;
        $this->isAm = true;
        
      }
      else if($this->carbon->isMonday() && $setting->isCloseMondayPM()){
        $this->isHoliday = true;
        $this->isPm = true;
      }
      else if($this->carbon->isTuesday() && $setting->isCloseTuesdayAM()){
        $this->isHoliday = true;
        $this->isAm = true;
      }
      else if($this->carbon->isTuesday() && $setting->isCloseTuesdayPM()){
        $this->isHoliday = true;
        $this->isPm = true;
      }
      else if($this->carbon->isWednesday() && $setting->isCloseWednesdayAM()){
        $this->isHoliday = true;
        $this->isAm = true;
      }
      else if($this->carbon->isWednesday() && $setting->isCloseWednesdayPM()){
        $this->isHoliday = true;
        $this->isPm = true;
      }
      else if($this->carbon->isThursday() && $setting->isCloseThursdayAM()){
        $this->isHoliday = true;
        $this->isAm = true;
      }
      else if($this->carbon->isThursday() && $setting->isCloseThursdayPM()){
        $this->isHoliday = true;
        $this->isPm = true;
      }
      else if($this->carbon->isFriday() && $setting->isCloseFridayAM()){
        $this->isHoliday = true;
        $this->isAm = true;
      }
      else if($this->carbon->isFriday() && $setting->isCloseFridayPM()){
        $this->isHoliday = true;
        $this->isPm = true;
      }
      else if($this->carbon->isSaturday() && $setting->isCloseSaturdayAM()){
        $this->isHoliday = true;
        $this->isAm = true;
      }
      else if($this->carbon->isSaturday() && $setting->isCloseSaturdayPM()){
        $this->isHoliday = true;
        $this->isPm = true;
      }
      else if($this->carbon->isSunday() && $setting->isCloseSundayAM()){
        $this->isHoliday = true;
        $this->isAm = true;
      }
      else if($this->carbon->isSunday() && $setting->isCloseSundayPM()){
        $this->isHoliday = true;
        $this->isPm = true;
      }
      
      //祝日は曜日とは別に判定する
      if($setting->isCloseHolidayAM() && $setting->isHoliday($this->carbon)){
        $this->isHoliday = true;
        $this->isAm = true;
      }
      else if($setting->isCloseHolidayPM() && $setting->isHoliday($this->carbon)){
        $this->isHoliday = true;
        $this->isPm = true;
      }
      
    }
  }
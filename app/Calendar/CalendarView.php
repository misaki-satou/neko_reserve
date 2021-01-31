<?php
namespace App\Calendar;
use Carbon\Carbon;
use App\Models\HolidaySetting;
use App\Models\ExtraHoliday;
class CalendarView {
  protected $carbon;
  protected $holidays = [];

  function __construct($date){
    $this->carbon = new Carbon($date);
  }
  /**
  * タイトル
  */
  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }
  /**
  * 前月を取得する
  */
  protected function getBeforeMonth(){
    
  }
  /**
  * 次月を取得する
  */
  protected function getNextMonth(){
  
  }
    
  /**
  * 週の情報を取得する
  */
  protected function getWeeks(){
    $weeks = [];

    //初日
    $firstDay = $this->carbon->copy()->firstOfMonth();

    //月末まで
    $lastDay = $this->carbon->copy()->lastOfMonth();

    //1週目
    //$week = new CalendarWeek($firstDay->copy());
    //$weeks[] = $week;
    $weeks[] = $this->getWeek($firstDay->copy());

    //作業用の日
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();

    //月末までループさせる
    while($tmpDay->lte($lastDay)){
      //週カレンダーViewを作成する
      //$week = new CalendarWeek($tmpDay, count($weeks));
      //$weeks[] = $week;
      $weeks[] = $this->getWeek($tmpDay->copy(), count($weeks));
      //次の週=+7日する
      $tmpDay->addDay(7);
    }
      return $weeks;
  }
  
  /**
  * @return CalendarWeek
  */
  protected function getWeek(Carbon $date, $index = 0){
    return new CalendarWeek($date, $index);
  }

  /**
   * カレンダーを出力する
  */
  function render(){
    //HolidaySetting
    //$setting = HolidaySetting::firstOrNew();
    $setting = HolidaySetting::first();
    $setting->loadHoliday($this->carbon->format("Y"));

    //臨時営業日の読み込み
    $this->holidays = ExtraHoliday::getExtraHolidayWithMonth($this->carbon->format("Ym"));
  
  
    $html = [];
    $html[] = '<div class="calendar">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';
      $days = $week->getDays($setting);
      foreach($days as $day){
        $html[] = '<td class="'.$day->getClassName().'">';
        $html[] = $day->render();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    
    $html[] = '</tbody>';
    
    $html[] = '</table>';
    $html[] = '</div>';
    return implode("", $html);
  }
}
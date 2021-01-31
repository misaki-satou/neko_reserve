<?php
  /*
  * 前の月、次の月の余白を出力するためのクラス
  */
  namespace App\Calendar;

  /**
  * 余白を出力するためのクラス
  */
  class CalendarWeekBlankDay extends CalendarWeekDay {
    
      function getClassName(){
      return "day-blank";
    }

    /**
     * @return 
     */
    function render(){
      return '';
    }

  }
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReserveSetting extends Model
{
  //モデルと関連しているテーブル
  protected $table = 'm_reserves_settings';
  // テーブルの主キー
  protected $primaryKey = 'reserve_setting_id';
  
  protected $guarded = [
    'reserve_setting_id',
    'facility_id',
    'created_at',
    'updated_at'
  ];
}

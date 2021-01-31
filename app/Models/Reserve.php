<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
  //モデルと関連しているテーブル
  protected $table = 't_reserves';
  // テーブルの主キー
  protected $primaryKey = 'reserve_id';
  
  protected $guarded = [
    'reserve_id',
    'created_at',
    'updated_at'
  ];
}

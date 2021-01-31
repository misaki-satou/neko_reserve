<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
  //モデルと関連しているテーブル
  protected $table = 'm_facilities';
  // テーブルの主キー
  protected $primaryKey = 'facility_id';
  
  protected $guarded = [
    'facility_id',
    'facility_name',
    'facility_zip',
    'facility_address',
    'facility_phone',
    'facility_fax',
    'facility_mail_address',
    'facility_url',
    'created_at',
    'updated_at'
  ];
}

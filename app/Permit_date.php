<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permit_date extends Model
{
  protected $table = 'permit_date';
  protected $fillable = ['permit_id','date','start_at','end_at'];
}

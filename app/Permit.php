<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
   protected $table = 'permit';
   protected $fillable = ['user_id','type','desc','status','approved_by','approved_at'];
}

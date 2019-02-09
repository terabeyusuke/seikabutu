<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profilehistory extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
      'profile_id' => 'required',
      'sdited_at' => 'required',
    );
}

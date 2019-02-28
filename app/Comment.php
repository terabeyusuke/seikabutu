<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
      'comment' => 'required',
    );

    public function comments(){
      return $tish->hasMany('App\News');
    }

}

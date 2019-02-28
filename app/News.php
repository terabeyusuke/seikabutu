<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Like;

class News extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
      'title' => 'required',
      'body' => 'required',
      'category' => 'required'
    );

    public function histories()
    {
      return $this->hasMany('App\History');
    }

    public function comments(){
     return $this->hasMany('App\Comment');
    }


    protected $fillable = ['title', 'body', 'summary', 'user_id'];

    public function comment() {
      return $this->hasMany('App\comment');
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function likes()
    {
      return $this->hasMany('App\Like');
    }

    public function like_by()
    {
      return Like::where('user_id', Auth::user()->id)->first();
    }
}

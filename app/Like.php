<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use kanazaca\CounterCache\CounterCache;

class Like extends Model
{
    use CounterCache;

    public $counterCacheOptions = [
        'News' => [
            'field' => 'likes_count',
            'foreignKey' => 'news_id'
        ]
    ];

    protected $fillable = ['user_id', 'news_id'];

    public function News()
    {
      return $this->belongsTo('App\News');
    }

    public function User()
    {
      return $this->belongsTo(User::class);
    }

}

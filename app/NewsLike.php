<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsLike extends Model
{
    public $timestamps = false;

    //Mass assigned
    protected $fillable = [
        'news_id',
        'user_id',
    ];
}

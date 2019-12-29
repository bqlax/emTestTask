<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoLike extends Model
{
    public $timestamps = false;

    //Mass assigned
    protected $fillable = [
        'photo_id',
        'user_id',
    ];
}

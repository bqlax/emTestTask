<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //Mass assigned
    protected $fillable = [
        'title',
        'slug',
        'text',
        'text_short',
        'created_by',
        'modified_by'
    ];

}

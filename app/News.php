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

    /**
     * Get all likes of news
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany('App\NewsLike');
    }
}

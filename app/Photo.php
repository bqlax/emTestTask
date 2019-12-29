<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //Mass assigned
    protected $fillable = [
        'name',
        'slug',
        'path',
        'created_by',
        'modified_by'
    ];

    /**
     * Get all likes of photos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany('App\PhotoLike');
    }
}

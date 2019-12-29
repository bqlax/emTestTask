<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait LittleHelpers
{
    /**
     * Method helps organize liked posts by auth user
     *
     * @param $dataArr
     * @param $modelLikes
     * @param $foreignKey
     * @return array
     */
    public function getLikedRows($dataArr, $modelLikes, $foreignKey)
    {
        //array for ids of posts
        $ids = [];
        foreach ($dataArr['data'] as $row) {
            $ids[] = $row['id'];
        }

        //get likes by posts(ids) and auth user_id
        $dataLikesObj = $modelLikes::whereIn($foreignKey, $ids)->where('user_id', Auth::user()->id)->get();

        //array for likes posts by current user
        $liked = [];
        foreach ($dataLikesObj as $rowLike) {
            $liked[$rowLike->$foreignKey] = true;
        }

        //return array which contains ids of liked posts by current user
        return $liked;
    }
}
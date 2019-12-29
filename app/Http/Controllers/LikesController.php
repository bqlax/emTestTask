<?php

namespace App\Http\Controllers;

use App\News;
use App\NewsLike;
use App\Photo;
use App\PhotoLike;
use Illuminate\Http\Request;
use App\Http\Requests\LikeRequest;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    private $field;
    private $request;
    private $model;
    private $modelLikes;

    /**
     * Route action like
     *
     * @param LikeRequest $request
     * @return string
     */
    public function like(LikeRequest $request)
    {
        $this->request = $request;
        if ($request->news_id) {
            return json_encode($this->setNewsLike());
        } else {
            return json_encode($this->setPhotoLike());
        }
    }

    /**
     * Set fields for news like
     * Call like
     *
     * @return array
     */
    public function setNewsLike()
    {
        $this->field = 'news_id';
        $this->model = News::class;
        $this->modelLikes = NewsLike::class;
        return $this->setLike();
    }

    /**
     * Set fields for photos like
     * Call like
     *
     * @return array
     */
    public function setPhotoLike()
    {
        $this->field = 'photo_id';
        $this->model = Photo::class;
        $this->modelLikes = PhotoLike::class;
        return $this->setLike();
    }

    /**
     * Set like method
     *
     * @return array
     */
    public function setLike()
    {
        //get field
        $field = $this->field;

        //get value from request by field
        $value = $this->request->$field;

        //Check if like exists by current auth user
        $likeQuery = $this->modelLikes::where($field, $value)->where('user_id', Auth::user()->id);
        if ($likeQuery->exists()) {
            //if yes, unset like
            $likeQuery->delete();

            //decrement count of likes in current post
            $this->model::where('id', $value)->decrement('likes', 1);
        } else {
            //if no, set like to current post with id of current user
            $this->modelLikes::create(array_merge($this->request->all(), [
                'user_id' => Auth::user()->id
            ]));

            //increment count of likes in current post
            $this->model::where('id', $value)->increment('likes', 1);
        }

        //return array of updated count likes
        return ['likes' => $this->model::select('likes')->where('id', $value)->get()[0]->likes];
    }
}

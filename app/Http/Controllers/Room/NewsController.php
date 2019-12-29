<?php

namespace App\Http\Controllers\Room;

use App\News;
use App\NewsLike;
use Illuminate\Http\Request;
use App\Http\Requests\RoomNewsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\LittleHelpers;

class NewsController extends Controller
{
    use LittleHelpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get list of news with pagination
        $news = News::orderBy('created_at', 'desc')->paginate(10);

        //organize liked posts with received posts (limit by pagination)
        $liked = $this->getLikedRows($news->toArray(), NewsLike::class, 'news_id');

        return view('room.news.index', [
            'news' => $news,
            'liked' => $liked
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('room.news.create', [
            'news' => [
                'title' => null,
                'text' => null,
                'text_short' => null,
                'slug' => null,
                'modified_by' => null
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomNewsRequest $request)
    {
        News::create(array_merge($request->all(), [
            'created_by' => Auth::user()->id,
            'modified_by' => Auth::user()->id
        ]));
        return json_encode(['action' => route('room.news.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        //get post
        $article = News::where('slug', $slug)->first();

        /*
         * check if post liked by current user
         * variant 1 - relation
         * variant 2 of checking presented in PhotosController@show
         */
        $isLiked = $article->likes()->where('user_id', Auth::user()->id)->exists();

        return view('room.news.show', [
            'article' => $article,
            'isLiked' => $isLiked
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        if (Auth::user()->id == $news->created_by) {
            return view('room.news.edit', [
                'news' => $news
            ]);
        }
        return view('room.news.index');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(RoomNewsRequest $request, News $news)
    {
        if (Auth::user()->id == $news->created_by) {
            $news->update($request->toArray());
        }
        return json_encode(['action' => route('room.news.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        if (Auth::user()->id == $news->created_by) {
            //also delete all likes
            $news->likes()->delete();
            $news->delete();
        }

        return redirect()->route('room.news.index');
    }
}

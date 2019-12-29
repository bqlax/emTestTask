<?php

namespace App\Http\Controllers\Room;

use App\Photo;
use App\PhotoLike;
use Illuminate\Http\Request;
use App\Http\Requests\RoomPhotoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\LittleHelpers;

class PhotoController extends Controller
{
    use LittleHelpers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get list of photos with pagination
        $photos = Photo::orderBy('created_at', 'desc')->paginate(10);

        //organize liked posts with received posts (limit by pagination)
        $liked = $this->getLikedRows($photos->toArray(), PhotoLike::class, 'photo_id');

        return view('room.photos.index', [
            'photos' => $photos,
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
        return view('room.photos.create', [
            'photo' => [
                'name' => null,
                'slug' => null,
                'path' => null
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomPhotoRequest $request)
    {
        Photo::create(array_merge($request->all(), [
            'created_by' => Auth::user()->id,
            'modified_by' => Auth::user()->id
        ]));
        return json_encode(['action' => route('room.photos.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //get post
        $photo = Photo::where('slug', $slug)->first();

        /*
         * check if post liked by current user
         * variant 2 - via simple builder sql with indexed field
         * variant 1 of checking with relation presented in NewsController@show
         */
        $isLiked = PhotoLike::where('photo_id', $photo->id)->where('user_id', Auth::user()->id)->exists();

        return view('room.photos.show', [
            'photo' => $photo,
            'isLiked' => $isLiked
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        if (Auth::user()->id == $photo->created_by) {
            return view('room.photos.edit', [
                'photo' => $photo
            ]);
        }
        return view('room.photos.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(RoomPhotoRequest $request, Photo $photo)
    {
        if (Auth::user()->id == $photo->created_by) {
            $photo->update($request->toArray());
        }
        return json_encode(['action' => route('room.photos.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        if (Auth::user()->id == $photo->created_by) {
            //also delete all likes
            $photo->likes()->delete();
            $photo->delete();
        }

        return redirect()->route('room.photos.index');
    }
}

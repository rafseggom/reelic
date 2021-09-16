<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Rating::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|string|in:upvote,downvote',
            'photo_id' => 'required|integer',
        ]);
        $rating = new Rating(['rating' => $request->rating == 'upvote' ? 1 : -1, 'photo_id' => $request->photo_id,'user_id'=>Auth::user()->id]);
        try {
            $rating->save();
        } catch (\Throwable $th) {
            return response()->json(['message'=>'You already voted this photo'],403);
        }
        //return $rating;

        return Photo::query()->find($request->photo_id)->getSumRating();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Rating::find($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ratingPhoto($id)
    {
        $photo = Photo::query()->findOrFail($id);
        if ($photo instanceof Photo) {
            return $photo->ratings()->get(['rating'])->sum('rating');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rating = Rating::find($id);
        $rating->update($request->all());
        return $rating;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rating::destroy($id);
    }
}

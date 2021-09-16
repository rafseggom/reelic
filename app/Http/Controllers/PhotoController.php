<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use App\Models\User;
use ConsoleTVs\Profanity\Facades\Profanity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class  PhotoController extends Controller
{

    public function create($id)
    {
        $photo = Photo::find($id);
        $photo->tags = $photo->categories()->get()->map(function( Category $cat) {
            return strtolower($cat->tag);
        })->toArray();
        return view('photo.create', compact('photo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photos = Photo::query()->find($id);
        $photos->title=Profanity::blocker($photos->title)->filter();
        $photos->description=Profanity::blocker($photos->description)->filter();
        if ($photos instanceof Photo) {
            $photos->tags = $photos->categories()->get()->map(function($item) {
                return strtolower($item->tag=Profanity::blocker($item->tag)->filter());
            })->toArray();
            // return response()->json($photos->tags);
        }
        if ($photos instanceof Photo) {
            $photos->user = $photos->user()->get()->first();
            $photos->comments = $photos->comments()->get()->reverse();
        }
        //return $photos->get=Profanity::blocker($photos->categories)->filter();
        return view('photo.show', compact('photos'));
    }

    //API

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Photo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return 'hola';
        $request->validate([
            /* 'title' => 'required',
            'description' => 'required',*/
            'file' => 'image|required'
        ]);

        $user = Auth::user();
        if($user instanceof User && $user ->photos()->get()->count()>=50){
            return redirect()->route('profile', ['id'=> Auth::id()]);
        }

        $photo = new Photo();
        $photo->title = '';
        $photo->description = '';


        $photo->user()->associate(Auth::id());

        $photo->path = Storage::disk('public')->put('photos', $request->file('file'));



        $photo->save();

        return redirect()->route('photos.edit', ['id' => $photo->id]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tag' => 'required',
        ]);


        $photo = Photo::query()->findOrFail($id);

        $photo->title = $request->title;
        $photo->description = $request->description;
        $photo->isPublic = $request->isPublic;

        $tags_array = explode(',',$request->tag);
        $tags_ids =array();
        foreach ($tags_array as $tag_str) {
            $tag = Category::query()->firstOrCreate(['tag' => Str::lower(trim($tag_str))]);
            $tags_ids[] = $tag->getAttributeValue('id');
        }

        if ($photo instanceof Photo) {
            $photo->categories()->sync($tags_ids);
        }

        $photo->save();

        //Tags
        //$category = new Category();
        /*  $category = Category::firstOrCreate([
            'tag' => '$category->tag'
        ]); */

        //$category->tag = '';

        return redirect()->route('photos.show', ['id' => $photo->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Photo::destroy($id);

        return redirect()->route('home');
    }

    /**
     * Search for a title.
     *
     * @param  int  $title
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Photo::where('title', 'like', '%' . $name . '%')->get();
    }


}

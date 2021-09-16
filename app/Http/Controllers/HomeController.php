<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Rating;
use App\Models\User;
use Database\Seeders\PhotoSeeder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {

        $photosQuery = Photo::query()->where('isPublic', '=', '1');

        if ($request->order == 'desc') {
            $order = 'desc';
        } else {
            $order = 'asc';
        }

        if ($request->orderBy == 'date') {
            $orderBy = 'created_at';
        } elseif ($request->orderBy == 'filter') {
            $filterBy = 'rating';
        }

        if ($request->search) {
            $search = $request->search;
            $photosQuery->whereHas('categories', function (Builder $query) use ($search) {
                $query->where('tag', 'like', $search);
            });
        }


        $photos = $photosQuery->orderBy($orderBy ?? 'created_at', $order ?? 'desc')->paginate();
        return view('home.home', compact('photos'));
    }

    public function login()
    {
        return view('home.login');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function profile(Request $request, $id)
    {
        $user = User::query()->find($id);
        if ($user instanceof User) {
            // $photos = $user->photos()->getQuery()->paginate();
            $totalPhotos = $user->getTotalPhotos();
            $photosQuery = $user->photos()->getQuery();
            if (Auth::id() != $id) {
                $photosQuery->where('isPublic', '=', '1');
            }
            $photos = $photosQuery->paginate();
        }
        //$photos = Photo::find($id)->paginate();
        $uploadWarning = $request->get('uploadLimit') ?? 0;

        return view('home.profile', compact('user', 'photos', 'totalPhotos', 'uploadWarning'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user instanceof User && $user->photos()->get()->count() >= 50) {
            return redirect()->route('profile', ['id' => Auth::id(), 'uploadLimit' => true]);
        }
        return view('home.upload');
    }

    public function stats()
    {
        $topRatedPhotos = DB::select('SELECT photos.id, photos.title, sum(ratings.rating) as topRated from photos LEFT JOIN ratings ON photos.id = ratings.photo_id GROUP BY photos.id ORDER BY topRated desc LIMIT 5;');
        $topCommentedPhotos = DB::select('SELECT photos.id,photos.title, count(comments.comment) as topCommented from photos LEFT JOIN comments ON photos.id = comments.photo_id GROUP BY photos.id ORDER BY topCommented desc LIMIT 5;');
        $topTagged = DB::select('SELECT categories.id, categories.tag, count(photos.id) as topTagged from categories INNER JOIN category_photo on categories.id = category_photo.category_id INNER JOIN photos on photos.id = category_photo.photo_id GROUP BY categories.id ORDER BY topTagged desc LIMIT 5;');
        $mostLiked = DB::select('SELECT users.id, users.name,sum(ratings.rating) as mostLiked from users INNER JOIN photos ON users.id = photos.user_id INNER JOIN ratings on photos.id = ratings.photo_id WHERE photos.isPublic=1 GROUP BY users.id ORDER BY mostLiked desc LIMIT 5;');

        return view('home.stats', compact('topRatedPhotos', 'topCommentedPhotos', 'topTagged', 'mostLiked'));
    }
}

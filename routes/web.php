<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotoController;
//use App\Http\Controllers\UploadImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']],function(){

    Route::get('upload', [HomeController::class, 'create'])->name('upload');

});

/*HomeController*/


Route::get('contact', [HomeController::class, 'contact'])->name('contact');

Route::get('log', [HomeController::class, 'login']);

Route::get('stats', [HomeController::class, 'stats'])->name('stats');

Route::get('profile/{id}', [HomeController::class, 'profile'])->name('profile');



//Route::get('welcome', [HomeController::class, 'welcome']);

/*PhotoController*/

//Route::get('photo/upload', [PhotoController::class, 'create'])->name('photos.edit');
Route::get('photos/edit/{id}', [PhotoController::class, 'create'])->name('photos.edit');
// /\
// |
Route::post('photos', [PhotoController::class, 'store'])->name('photos.store');


Route::put('photos/{id}', [PhotoController::class, 'update'])->name('photos.update');

Route::get('photos/{id}', [PhotoController::class, 'show'])->name('photos.show');
/* Route::get('photo/{photoId}', [PhotoController::class, 'show'])->name('photos.show'); */

Route::delete('photos/{id}', [PhotoController::class, 'destroy'])->name('photos.destroy');




/*
Route::get('users/{id}/{dni?}', function ($id, $dni = null) {

    if ($dni) {
        return "Condicion if pasada, la id = $id y el dni = $dni";
    } else {
        return "Condicion if no pasada, id = $id";
    }
});
*/

<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\EpisodeController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\LikeController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\SeriesController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\StaffRoleController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\VoteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Account\UserAccountController;

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
})->name('home');

// Route::get('/forgot', function () {
//     return view('accounts.forgot');
// });
// Route::get('/signin', function () {
//     return view('accounts.signin');
// });
// Route::get('/signup', function () {
//     return view('accounts.signup');
// });
// Route::get('/users', function () {
//     return view('accounts.users');
// });
// Route::get('/edit-user', function () {
//     return view('accounts.edit-user');
// });
Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/signin', [AccountController::class,'signin'])->name('accounts.signin');
    Route::post('/signin', [AccountController::class,'login'])->name('accounts.login');
    Route::get('/signup', [AccountController::class,'signup'])->name('accounts.signup');
    Route::post('/signup', [AccountController::class,'register'])->name('accounts.register');
    Route::get('/logout', [AccountController::class,'logout'])->name('accounts.logout');
});

Route::get('/signin', [UserAccountController::class,'signin'])->name('accounts.signin');
Route::post('/signin', [UserAccountController::class,'login'])->name('accounts.login');
Route::get('/signup', [UserAccountController::class,'signup'])->name('accounts.signup');
Route::post('/signup', [UserAccountController::class,'register'])->name('accounts.register');
Route::get('/logout', [UserAccountController::class,'logout'])->name('accounts.logout');

Route::name('admin.')->prefix('admin')->middleware(['staff'])->group(function () {

    Route::get('/', function () {
        return view('index');
    })->name('home');
    
    Route::resource('genres',GenreController::class);
    Route::resource('authors',AuthorController::class);
    Route::resource('advertisements',AdvertisementController::class);
    Route::resource('comments',CommentController::class);
    Route::resource('countries',CountryController::class);
    Route::resource('likes',LikeController::class);
    Route::resource('series',SeriesController::class);
    Route::resource('staffs',StaffController::class);
    Route::resource('staff_roles',StaffRoleController::class);
    Route::resource('users',UserRoleController::class);
    Route::resource('user_roles',UserRoleController::class);
    Route::resource('votes',VoteController::class);
    Route::resource('episodes',EpisodeController::class);
    Route::resource('movies',MovieController::class);
    Route::resource('users',UserController::class);
});


Route::get('/404', function () {
    return view('404');
});
Route::get('/add-item', function () {
    return view('add-item');
});

Route::get('/comments', function () {
    return view('comments');
});
Route::get('/reviews', function () {
    return view('reviews');
});
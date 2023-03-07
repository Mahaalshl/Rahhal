<?php

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
    return view('home');
});

Route::post('/login',[\App\Http\Controllers\AuthenticationController::class,'login']);
Route::post('/signup',[\App\Http\Controllers\AuthenticationController::class,'signup']);
Route::get('/logout',[\App\Http\Controllers\AuthenticationController::class,'logout']);


Route::get('/master', function () {
    return view('master');
});

Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
//Post Routes
Route::get('/post/create',[\App\Http\Controllers\PostsController::class,'createPage']);
Route::post('/post/create',[\App\Http\Controllers\PostsController::class,'create']);
Route::get('/posts',[\App\Http\Controllers\PostsController::class, 'all']);
Route::get('/post/{id}',[\App\Http\Controllers\PostsController::class, 'single']);
Route::get('/post/{id}/edit',[\App\Http\Controllers\PostsController::class, 'editPage']);
Route::post('/post/{id}/edit',[\App\Http\Controllers\PostsController::class, 'edit']);
Route::post('/post/comment',[\App\Http\Controllers\PostsController::class, 'comment']);
Route::get('/post/delete/{id}',[\App\Http\Controllers\PostsController::class, 'delete']);
Route::get('/post/{id}/like',[\App\Http\Controllers\PostsController::class, 'like']);

//Places Routes
Route::get('/place/create',[\App\Http\Controllers\PlacesController::class,'createPage']);
Route::post('/place/create',[\App\Http\Controllers\PlacesController::class,'create']);
Route::get('/places',[\App\Http\Controllers\PlacesController::class, 'all']);
Route::get('/place/{id}',[\App\Http\Controllers\PlacesController::class, 'single']);
Route::get('/place/{id}/edit',[\App\Http\Controllers\PlacesController::class, 'editPage']);
Route::post('/place/{id}/edit',[\App\Http\Controllers\PlacesController::class, 'edit']);
Route::post('/place/comment',[\App\Http\Controllers\PlacesController::class, 'comment']);
Route::get('/place/delete/{id}',[\App\Http\Controllers\PlacesController::class, 'delete']);
Route::get('/place/{id}/like',[\App\Http\Controllers\PlacesController::class, 'like']);

//Events Routes
Route::get('/event/create',[\App\Http\Controllers\EventsController::class,'createPage']);
Route::post('/event/create',[\App\Http\Controllers\EventsController::class,'create']);
Route::get('/events',[\App\Http\Controllers\EventsController::class, 'all']);
Route::get('/events/upcoming',[\App\Http\Controllers\EventsController::class, 'upcoming']);
Route::get('/event/{id}',[\App\Http\Controllers\EventsController::class, 'single']);
Route::get('/event/{id}/edit',[\App\Http\Controllers\EventsController::class, 'editPage']);
Route::post('/event/{id}/edit',[\App\Http\Controllers\EventsController::class, 'edit']);
Route::post('/event/comment',[\App\Http\Controllers\EventsController::class, 'comment']);
Route::get('/event/delete/{id}',[\App\Http\Controllers\EventsController::class, 'delete']);
Route::get('/event/{id}/like',[\App\Http\Controllers\EventsController::class, 'like']);


//Requests Routes
Route::get('/request/create',[\App\Http\Controllers\RequestsController::class,'createPage']);
Route::post('/request/create',[\App\Http\Controllers\RequestsController::class,'create']);
Route::get('/requests',[\App\Http\Controllers\RequestsController::class, 'all']);
Route::get('/request/{id}',[\App\Http\Controllers\RequestsController::class, 'single']);
Route::get('/request/{id}/edit',[\App\Http\Controllers\RequestsController::class, 'editPage']);
Route::post('/request/comment',[\App\Http\Controllers\RequestsController::class, 'comment']);
Route::post('/request/{id}/edit',[\App\Http\Controllers\RequestsController::class, 'edit']);
Route::get('/request/{id}/accept',[\App\Http\Controllers\RequestsController::class, 'accept']);
Route::get('/request/{id}/reject',[\App\Http\Controllers\RequestsController::class, 'reject']);
Route::get('/request/delete/{id}',[\App\Http\Controllers\RequestsController::class, 'delete']);

// user 
Route::get('/users', [\App\Http\Controllers\UsersController::class, 'all']);
Route::get('/user/create', [\App\Http\Controllers\UsersController::class, 'createPage']);
Route::post('/user/create', [\App\Http\Controllers\UsersController::class, 'create']);
Route::get('/user/delete/{id}', [\App\Http\Controllers\UsersController::class, 'delete']);
Route::get('/user/promote/{id}', [\App\Http\Controllers\UsersController::class, 'promote']);
Route::get('/user/dispromote/{id}', [\App\Http\Controllers\UsersController::class, 'dispromote']);

Route::get('/user/{id}/edit', [\App\Http\Controllers\UsersController::class, 'editPage']);
Route::post('/user/{id}/edit', [\App\Http\Controllers\UsersController::class, 'edit']);
Route::get('/user/{id}/like',[\App\Http\Controllers\UsersController::class, 'likeCount']);


//comment Routes
Route::get('/comment/delete/{id}', [\App\Http\Controllers\CommentController::class, 'delete']);
Route::get('/comments', [\App\Http\Controllers\CommentController::class, 'negative']);

//contact Routes
Route::get('/contact',[\App\Http\Controllers\contactController::class,'contact']);
Route::post('/contact',[\App\Http\Controllers\contactController::class, 'sendMail'])->name('contact.us');

// hpme 
Route::get('/{locale?}', [\App\Http\Controllers\HomeController::class, 'index']);

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => '\App\Http\Controllers\LanguageController@switchLang']);


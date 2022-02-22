<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\SearchController;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/post', [PostsController::class, 'index']);
//Route::get('/', 'App\Http\Controllers\PostController@index');
//Route::get('/', 'PostsController@index');
Route::post('/post', [PostsController::class, 'save']);
//Route::post('/', 'App\Http\Controllers\PostController@save');
//Route::post('/', 'PagesController@save');

Route::resource('/topics', TopicsController::class);
//Route::resource('/topics', 'TopicsController');
Route::get('/topics/softdelete', function() {
    topics::find(1)->delete();
});
//Route::resource('/topics', SearchController::class);
//検索機能で必要なルート（仮）
Route::get('/', [SearchController::class, 'index']);
Route::post('/', [SearchController::class, 'index']);
Route::get('/index', [SearchController::class, 'index']);
Route::post('/index', [SearchController::class, 'index']);
//Route::post('/', [SearchController::class, 'save']);
Route::get('/post', function () {
  return view('post');
});
/*
Route::get('/', function () {
  return view('/');
});
*/
//Route::resource('/topics', SearchController::class);
Route::resource('/edit', TopicsController::class);

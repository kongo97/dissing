<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YoutubeController;
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

Route::get('/', [YoutubeController::class, 'index']);

Route::post('/search', [YoutubeController::class, 'search']);

Route::post('/getBeat', [YoutubeController::class, 'getBeat']);

Route::post('/getWords', [YoutubeController::class, 'getWords']);

Route::get('/oauth2callback', [YoutubeController::class, 'oauth2callback']);

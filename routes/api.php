<?php

use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('throttle:60,1')->prefix('v1')->domain(env('API_DOMAIN', 'api.chia2.com'))->group(function() {
    Route::get('/articles/{page?}', [PostController::class, 'index'])->name('blog.articles');
    Route::get('/article/{id}',  [PostController::class, 'detail'])->where(['id' => '[1-9]{1}[0-9]*']);
});

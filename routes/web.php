<?php

use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\Admin\MovieController;

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
    return view('welcome');
});

    Route::resource('movies', MovieController::class);

    Route::post('/image/removeImage', [\App\Http\Controllers\Admin\ImageController::class, 'removeImage']);

Auth::routes();

   // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
    Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
        //
        Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index']);

   //    Route::get('/movie', [App\Http\Controllers\Admin\MovieController::class, 'index']);
//
   //    //Виправити на post
   //    Route::get('/movie/create', [App\Http\Controllers\Admin\MovieController::class, 'create']);



    });

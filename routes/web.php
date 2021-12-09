<?php

use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Facades\Auth;
    use App\Http\Controllers\Admin\MovieController;
    use App\Http\Controllers\Admin\CinemaController;
    use App\Http\Controllers\Admin\HallController;
    use App\Http\Controllers\Admin\NewsController;
    use App\Http\Controllers\Admin\ActionController;
    use App\Http\Controllers\Admin\PageController;
    use App\Http\Controllers\Admin\MainPageController;
    use App\Http\Controllers\Admin\ContactController;
    use App\Http\Controllers\Admin\ContactCinemaController;
    use App\Http\Controllers\Admin\UserController;

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
    Route::resource('cinema', CinemaController::class);
    Route::resource('hall', HallController::class);
    Route::resource('news', NewsController::class);
    Route::resource('action', ActionController::class);
    Route::resource('pages', PageController::class);
    Route::resource('main-page', MainPageController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('contact-cinema', ContactCinemaController::class);
    Route::resource('user', UserController::class);

    Route::post('/image/removeImage', [\App\Http\Controllers\Admin\ImageController::class, 'removeImage']);
    Route::post('/cinema-image/removeImage', [\App\Http\Controllers\Admin\CinemaImageController::class, 'removeImage']);
    Route::post('/hall-image/removeImage', [\App\Http\Controllers\Admin\HallImageController::class, 'removeImage']);

Auth::routes();

   // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
    Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
        //
        Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index']);



    });

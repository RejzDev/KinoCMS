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
    use App\Http\Controllers\MailController;
    use App\Http\Controllers\Admin\BannerController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\Admin\TimeTablesController;

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
    Route::resource('banner', BannerController::class);
    Route::resource('main-banner', \App\Http\Controllers\Admin\MainBannerController::class);
    Route::resource('news-banner', \App\Http\Controllers\Admin\NewsBannerController::class);
    Route::resource('bg_banner', \App\Http\Controllers\Admin\BgBannerController::class);
    Route::resource('time-tables', TimeTablesController::class);

    Route::post('/image/removeImage', [\App\Http\Controllers\Admin\ImageController::class, 'removeImage']);
    Route::post('/cinema-image/removeImage', [\App\Http\Controllers\Admin\CinemaImageController::class, 'removeImage']);
    Route::post('/hall-image/removeImage', [\App\Http\Controllers\Admin\HallImageController::class, 'removeImage']);

    Route::post('send', [MailController::class, 'send'])->name('send');
    Route::post('save-user', [MailController::class, 'saveUser'])->name('saveUser');
    Route::get('mail-users', [MailController::class, 'mailUsers'])->name('mail.users');
    Route::get('mail', [MailController::class, 'index'])->name('mail.index');
    Route::get('mail-html', [MailController::class, 'addMail'])->name('mail.html');
    Route::post('mail-upload', [MailController::class, 'upload'])->name('mail.upload');
    Route::post('mail-sendMail', [MailController::class, 'sendMail'])->name('mail.sendMail');
    Route::post('mail-destroy', [MailController::class, 'destroy'])->name('mail.destroy');
    Route::post('movie-searches', [TimeTablesController::class, 'moviesSearches'])->name('movie.searches');
    Route::post('hall-searches', [TimeTablesController::class, 'hallsSearches'])->name('hall.searches');


    Route::get('/', [HomeController::class, 'index'])->name('index.home');
    Route::get('/ongoing-movies', [HomeController::class, 'OngoingMovies'])->name('ongoing.home');
    Route::get('/soon-movies', [HomeController::class, 'SoonMovies'])->name('soon.home');
    Route::get('/cinemas', [HomeController::class, 'cinemas'])->name('cinema.home');
    Route::get('/actions', [HomeController::class, 'actions'])->name('action.home');


    Auth::routes();

   Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index']);
    Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
        //
       // Route::get('/index', [App\Http\Controllers\Admin\HomeController::class, 'index']);



    });

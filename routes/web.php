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




    Auth::routes();


    Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
        //
        // Route::get('/index', [App\Http\Controllers\Admin\HomeController::class, 'index']);
        Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index']);
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
        Route::resource('genre', \App\Http\Controllers\Admin\GenreController::class);
        Route::post('/news-image/removeImage', [\App\Http\Controllers\Admin\NewsController::class, 'removeImage']);
        Route::post('/action-image/removeImage', [\App\Http\Controllers\Admin\ActionController::class, 'removeImage']);


    });



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
    Route::get('/timetables', [HomeController::class, 'timeTable'])->name('time-table.home');
    Route::post('/filter', [HomeController::class, 'filter'])->name('filter');
    Route::post('/filterMovie', [\App\Http\Controllers\MoviesController::class, 'filterMovie'])->name('filter_movie');
    Route::post('moviesearches', [HomeController::class, 'moviesSearches'])->name('movies.searches');
    Route::post('cinema-searches', [HomeController::class, 'cinemaSearches'])->name('cinema.searches');
    Route::post('halls-searches', [HomeController::class, 'hallsSearches'])->name('halls.searches');
    Route::post('save-booking', [\App\Http\Controllers\MoviesController::class, 'saveBooking'])->name('saveBooking');




    Route::get('/news', [HomeController::class, 'news'])->name('news.home');
    Route::get('locale/{locale}', [\App\Http\Controllers\HomeController::class, 'locale'])->name('locale');

    Route::get('movie/{id}', [\App\Http\Controllers\MoviesController::class, 'pageMovie'])->name('page.movie');
    Route::post('booking/{id}', [\App\Http\Controllers\MoviesController::class, 'booking'])->name('booking.movie');

    Route::get('page/{id}', [\App\Http\Controllers\PagesController::class, 'pages'])->name('page.page');
    Route::get('cinemas/{id}', [\App\Http\Controllers\CinemasController::class, 'index'])->name('page.cinema');
    Route::get('actions/{id}', [\App\Http\Controllers\ActionsController::class, 'index'])->name('actions.page');
    Route::get('halls/{id}', [\App\Http\Controllers\HallsController::class, 'index'])->name('halls.page');
    Route::get('users/{id}', [\App\Http\Controllers\UsersController::class, 'index'])->name('users.page');
    Route::post('users/update/{id}', [\App\Http\Controllers\UsersController::class, 'update'])->name('users.update');
    Route::get('contacts', [\App\Http\Controllers\HomeController::class, 'contacts'])->name('contacts.page');

    Route::get('/news', [HomeController::class, 'news'])->name('news.home');
    Route::get('locale/{locale}', [\App\Http\Controllers\HomeController::class, 'locale'])->name('locale');


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\News;
use App\Models\NewsBanner;
use App\Models\Cinema;
use App\Models\Action;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $movies = new Movie();
        $newsBanner= new NewsBanner();
        $date['state'] = $movies->getOngoingMovies();
        $date['soon'] = $movies->getSoonMovies();
        $date['banner'] = $newsBanner->getNewsBanner();

        return view('main.home', ['date' => $date]);
    }


    public function OngoingMovies()
    {
        $movies = new Movie();
        $date['data'] = $movies->getOngoingMovies();
        $date['title'] = 'Сейчас в кино';

        return view('movie.index', ['date' => $date]);
    }

    public function SoonMovies()
    {
        $movies = new Movie();
        $date['data']  = $movies->getSoonMovies();
        $date['title'] = 'Скоро в кино';

        return view('movie.index', ['date' => $date]);
    }

    public function cinemas()
    {
        $cinema = new Cinema();
        $date = $cinema->allCinema();


        return view('cinema.index', ['date' => $date]);
    }

    public function actions()
    {
        $action = new Action();
        $date = $action->getAction();

        foreach ($date as $item){
            $item['dates'] = Carbon::parse($item['created_at'])->format('Y-m-d');

        }


        return view('actions.index', ['date' => $date]);
    }
}

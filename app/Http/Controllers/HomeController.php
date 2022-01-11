<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\News;
use App\Models\NewsBanner;

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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\News;
use App\Models\NewsBanner;
use App\Models\Cinema;
use App\Models\Action;
use Illuminate\Support\Carbon;
use App\Models\TimeTable;
use App\Models\Hall;

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
        $movies = new TimeTable();
        $date['data'] = $movies->getOngoing();
        foreach ($date['data'] as $item){
            $item['title'] = 'Сейчас в кино';
        }


        return view('movie.index', ['date' => $date]);
    }

    public function SoonMovies()
    {
        $movies = new TimeTable();
        $date['data']  = $movies->getSoon();

        foreach ($date['data'] as $item){
            $item['title'] = 'С ' . $item['date'];
        }

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

    public function timeTable()
    {
        $model = new TimeTable();
        $movie = new Movie();




        $data['movies'] = $model->getOngoingToday();
        $data['date'] = $data['movies'][0]['date'];
        $data['movie'] = $movie->allMovie();

        return view('time_table.index', ['data' => $data]);
    }


    public function filter(Request $request)
    {


        $model = new TimeTable();

        $data = $request->all();

        $movie = new Movie();






        $result['movie'] = $movie->allMovie();

        $result['movies'] = $model->getfilter($data);

        $result['date'] = $result['movies'][0]->date;



        return view('time_table.filter', ['data' => $result]);
    }

    public function moviesSearches(Request $request)
    {

        $model = new Movie();

        $search = $request->search;


        if (is_null($search)){
            $result = $model->getLastMovies();
        }else{
            $result = $model->searches($search);
        }


        foreach ($result as $item) {
            $data[] =array(
                "id"=>$item['id'],
                "text"=>$item['name']
            );

        }

        $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];

        return response()->json($data, 200, $headers, JSON_UNESCAPED_UNICODE);



    }


    public function cinemaSearches(Request $request)
    {

        $model = new Cinema();

        $search = $request->search;


        if (is_null($search)){
            $result = $model->getLastHalls();
        }else{
            $result = $model->searches($search);
        }


        foreach ($result as $item) {

                $data[] = array(
                    "id" => $item['id'],
                    "text" => $item['name']
                );

        }

        $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];

        return response()->json($data, 200, $headers, JSON_UNESCAPED_UNICODE);



    }

}

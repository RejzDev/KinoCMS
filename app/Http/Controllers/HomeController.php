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
use App\Models\MainBanner;
use App\Models\MainPage;
use App\Models\Page;
use App\Models\ContactCinema;
use App\Models\BgBanner;
use App\Models\Banner;
use Illuminate\Support\Facades\App;

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
        $mainBanner= new MainBanner();
        $bgBanner= new BgBanner();
        $banner= new Banner();
        $mainPage = new MainPage();
        $data['state'] = $movies->getOngoingMovies();
        $data['soon'] = $movies->getSoonMovies();
        $data['newsBanner'] = $newsBanner->getNewsBanner();
        $data['mainBanner'] = $mainBanner->getMainBanners();
        $data['bgBanner'] = $bgBanner->getBgBanners();
        $data['banner'] = $banner->getBanners();
        $data['mainPage'] = $mainPage->getPage();



        return view('main.home', ['data' => $data]);
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
        $data['date'] = isset($data['movies'][0]['date']) ? $data['movies'][0]['date'] : null;
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

    public function hallsSearches(Request $request)
    {

        $model = new Cinema();

        $search = $request->search;


        if (is_null($search)){
            $result = $model->getLastHalls();
        }else{
            $result = $model->searches($search);
        }


        foreach ($result as $item) {

            foreach ($item['halls'] as $hall) {
                $data[] = array(
                    "id" => $hall['id'],
                    "text" => $item['name'] . ' (' . $hall['number'] . ' Зал)'
                );
            }

        }

        $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];

        return response()->json($data, 200, $headers, JSON_UNESCAPED_UNICODE);



    }


    public function cinemaPage(Request $request){


        return view('cinemas.page');

    }


    public function news()
    {
        $news = new News();
        $date = $news->getNews();

        foreach ($date as $item){
            $item['dates'] = Carbon::parse($item['created_at'])->format('Y-m-d');

        }


        return view('news.index', ['date' => $date]);
    }

    public function contacts()
    {
        $contacts = new ContactCinema();
        $date = $contacts->getContacts();
        $i = 0;
        foreach ($date as $item){
            $date[$i]['cord'] = explode(', ', $item['address']);
            $i++;
        }



        return view('contact.index', ['data' => $date]);
    }

    public function locale($locale)
    {
        session(['locale' => $locale]);
        App::setLocale($locale);
       $currentLocale = App::getLocale();

       return redirect()->back();
    }


}

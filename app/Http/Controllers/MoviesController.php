<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Movie;
    use Illuminate\Support\Carbon;
    use Jenssegers\Date\Date;
    use DateTimeZone;
    use App\Models\TimeTable;

    class MoviesController extends Controller
    {
        public function pageMovie(Request $request)
        {

            $movieModel = new Movie();


            //$id = $request->id;

            $movie = $movieModel->getMovieId(52);
            $date = Carbon::now(new DateTimeZone('Europe/Kiev'))->locale('ru');

            for ($i = 0; $i < 7; $i++) {
                if (isset($dates['date'][0]['day'])){
                    $dates['date'][$i]['day'] = $date->addRealDay()->day . ' ' . $date->shortDayName . ' ' . $date->monthName;
                    $dates['date'][$i]['format'] = $date->format('Y-m-d');
                } else{
                    $dates['date'][0]['day'] = $date->day . ' ' . $date->shortDayName . ' ' . $date->monthName;
                    $dates['date'][0]['format'] = $date->format('Y-m-d');
                }


            }





            return view('movie.cart', ['movie' => $movie,
                'date' => $dates]);
        }

        public function filterMovie(Request $request)
        {
            $model = new TimeTable();
            $movieModel = new Movie();


            //$id = $request->id;

            $movie = $movieModel->getMovieId(52);
            $date = Carbon::now(new DateTimeZone('Europe/Kiev'))->locale('ru');

            for ($i = 0; $i < 7; $i++) {
                if (isset($dates['date'][0]['day'])){
                    $dates['date'][$i]['day'] = $date->addRealDay()->day . ' ' . $date->shortDayName . ' ' . $date->monthName;
                    $dates['date'][$i]['format'] = $date->format('Y-m-d');
                } else{
                    $dates['date'][0]['day'] = $date->day . ' ' . $date->shortDayName . ' ' . $date->monthName;
                    $dates['date'][0]['format'] = $date->format('Y-m-d');
                }


            }


            $data = $request->all();

            $result['movies'] = $model->getfilter($data);

            foreach ($result['movies'] as $item){
                $item->time = Carbon::parse($item->time)->format('H:i');
            }

            return view('movie.cart', ['movie' => $movie,
                'date' => $dates,
                'result' => $result]);
        }
    }

<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Movie;
    use Illuminate\Support\Carbon;
    use Jenssegers\Date\Date;
    use DateTimeZone;
    use App\Models\TimeTable;
    use App\Models\Places;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Booking;

    class MoviesController extends Controller
    {
        public function pageMovie(Request $request, $id)
        {

            $movieModel = new Movie();


            $movie = $movieModel->getMovieId($id);
            $date = Carbon::now(new DateTimeZone('Europe/Kiev'))->locale('ru');

            for ($i = 0; $i < 7; $i++) {
                if (isset($dates['date'][0]['day'])) {
                    $dates['date'][$i]['day'] = $date->addRealDay()->day . ' ' . $date->shortDayName . ' ' . $date->monthName;
                    $dates['date'][$i]['format'] = $date->format('Y-m-d');
                } else {
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



            $data = $request->all();

            $movie = $movieModel->getMovieId($data['movie_id']);
            $date = Carbon::now(new DateTimeZone('Europe/Kiev'))->locale('ru');

            for ($i = 0; $i < 7; $i++) {
                if (isset($dates['date'][0]['day'])) {
                    $dates['date'][$i]['day'] = $date->addRealDay()->day . ' ' . $date->shortDayName . ' ' . $date->monthName;
                    $dates['date'][$i]['format'] = $date->format('Y-m-d');
                } else {
                    $dates['date'][0]['day'] = $date->day . ' ' . $date->shortDayName . ' ' . $date->monthName;
                    $dates['date'][0]['format'] = $date->format('Y-m-d');
                }


            }


            $data = $request->all();

            $result['movies'] = $model->getfilter($data);



            foreach ($result['movies'] as $item) {
                $item->time = Carbon::parse($item->time)->format('H:i');
            }

            return view('movie.cart', ['movie' => $movie,
                'date' => $dates,
                'result' => $result]);
        }

        public function booking(Request $request, $id)
        {
            $modelTime = new TimeTable();
            $movieModel = new Movie();
            $placesModel = new Places();

            $model = new Booking();




            $data = $request->all();



            $hall_id = $data['hall'];
            $time_table = $data['time_table_id'];
            $price = $data['price'];

            $book = $model->getBooking($time_table);
            $time = $modelTime->getId($time_table);


            $date = Carbon::parse($time->date)->locale('ru');


            $dates = $date->addRealDay()->day . ' ' . $date->monthName . ' ' . Carbon::parse($time->time)->format('H:i') . ' Зал № ' .  $time['halls']['number'];


            $movie = $movieModel->getMovieId($data['movie_id']);
            $places = $placesModel->getPlaces();
            $count = 1;


            foreach ($places as $place) {
                if ($count < 13) {
                    $data['col1'][] = $place;
                    $count++;
                    continue;
                }
                if ($count > 12 && $count <= 26) {
                    $data['col2'][] = $place;
                    $count++;
                    continue;
                }
                if ($count > 26 && $count <= 41) {
                    $data['col3'][] = $place;
                    $count++;
                    continue;
                }
                if ($count > 41 && $count <= 53) {
                    $data['col4'][] = $place;
                    $count++;
                    continue;
                }
                if ($count > 53 && $count <= 65) {
                    $data['col5'][] = $place;
                    $count++;
                    continue;
                }
                if ($count > 65 && $count <= 77) {
                    $data['col6'][] = $place;
                    $count++;
                    continue;
                }
                if ($count > 77 && $count <= 89) {
                    $data['col7'][] = $place;
                    $count++;
                    continue;
                }
                if ($count > 89 && $count <= 101) {
                    $data['col8'][] = $place;
                    $count++;
                    continue;
                }
                if ($count > 101 && $count <= 113) {
                    $data['col9'][] = $place;
                    $count++;
                    continue;
                }
                if ($count > 113 && $count <= 133) {
                    $data['col10'][] = $place;
                    $count++;
                }


            }


            return view('movie.booking', ['movie' => $movie,
                    'places' => $data,
                    'time_table' => $time_table,
                    'price' => $price,
                    'booking' => $book,
                    'date' => $dates]
            );
        }

        public function saveBooking(Request  $request)
        {

         $model = new Booking();





              $data = $request->all();



              foreach ($data['places'] as $item) {
                  $booking[] = explode(',', $item);
              }


              $data['booking'] = $booking;

            $bookings = array();
            $count = 0;
            for ($i = 0; $i < count($data['places']); $i++){
                array_push($bookings, array(
                    'row' => $data['booking'][$i][0],
                    'row_id' => $data['booking'][$i][1],
                    'place_id' => $data['booking'][$i][2],
                    'user_id' => Auth::user()->id,
                    'time_table_id' => $data['time_table_id'],
                ));

            }



            $model->create($bookings);
            return redirect(route('page.movie', $data['movie_id']))->withSuccess('Успешно!');

        }

    }

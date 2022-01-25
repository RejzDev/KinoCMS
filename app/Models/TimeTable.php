<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\DB;

class TimeTable extends Model
{
    use HasFactory;

    public function movies(){
        return $this->belongsTo(Movie::class, 'movie_id');

    }

    public function halls(){
        return $this->belongsTo(Hall::class, 'hall_id');

    }

    public function create(array $data): int
    {
         $this->time = $data['time'];
         $this->date = Carbon::parse( $data['date'])->format('Y-m-d');
         $this->price = $data['price'];
         $this->hall_id = $data['hall'];
         $this->movie_id = $data['movie'];

        $object = $this->save();

        return $this->id;
    }

    public function allTimeTable(){
        return $this->with('movies')->with('halls')->orderBy('id', 'desc')->get();
    }

    public function getOngoing(){
        return $this->with('movies')->with('halls')->whereMonth('date', Carbon::parse(Carbon::now(new DateTimeZone('Europe/Kiev')))->format('m'))
            ->get();

    }

    public function getSoon(){
        return $this->with('movies')->with('halls')->whereMonth('date','>', Carbon::parse(Carbon::now(new DateTimeZone('Europe/Kiev')))->format('m'))
            ->get();

    }

    public function getOngoingToday(){
        return $this->with('movies')->with('halls')->whereDay('date', Carbon::parse(Carbon::now(new DateTimeZone('Europe/Kiev')))->format('d'))
            ->get();

    }




    public function getfilter(array $data){


        $builder = TimeTable::join('movies', 'movies.id', '=', 'time_tables.movie_id')
       ->join('halls', 'halls.id', '=', 'time_tables.hall_id')->orderByDesc('date');



        $date = isset($data['date']) ? $data['date'] : null;
        $typeMovie = isset($data['type_movie']) ? implode(',', $data['type_movie']) : null;


        // отбираем только новинки
       if ($typeMovie) {
           $builder->where('type_movie',  'like', '%' . $typeMovie .'%');
       }
        // отбираем только лидеров продаж
        if (!is_null($date)) {

        $builder->where('date', '=', Carbon::parse($date)->format('Y-m-d'));

    }
        // отбираем только со скидкой
        if (isset($data['hall'])) {
            $builder->where('time_tables.hall_id', '=', $data['hall']);
        }

        // отбираем только со скидкой
        if (isset($data['movie'])) {
            $builder->where('time_tables.movie_id', '=', $data['movie']);
        }

        // отбираем только со скидкой
        if (isset($data['cinema'])) {
            $builder->where('halls.cinema_id', '=', $data['cinema']);
        }



        $products = $builder->get();
        return $products;


    }


}

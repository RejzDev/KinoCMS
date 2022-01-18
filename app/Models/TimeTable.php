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

       // return DB::table('time_tables')->join('movies', 'movies.id', '=', 'time_tables.movie_id')
       //     ->where('movies.id', '=', 52)->get();

   if (isset($data['type_movie'][0])){
       return DB::table('time_tables')->join('movies', 'movies.id', '=', 'time_tables.movie_id')
           ->join('halls', 'halls.id', '=', 'time_tables.hall_id')
           ->where('movies.type_movie', 'like', '%' . $data['type_movie'][0] .'%')->get();


   } elseif (!is_null($data['date'])){
       return DB::table('time_tables')->join('movies', 'movies.id', '=', 'time_tables.movie_id')
           ->join('halls', 'halls.id', '=', 'time_tables.hall_id')
           ->where('time_tables.date', '=', Carbon::parse($data['date'])->format('Y-m-d'))->get();

   } elseif (isset($data['hall'])){
       return DB::table('time_tables')->join('movies', 'movies.id', '=', 'time_tables.movie_id')
           ->join('halls', 'halls.id', '=', 'time_tables.hall_id')
           ->where('time_tables.hall_id', '=', $data['hall'])
           ->get();
   } elseif (!is_null($data['movie'])){
       return DB::table('time_tables')->join('movies', 'movies.id', '=', 'time_tables.movie_id')
           ->join('halls', 'halls.id', '=', 'time_tables.hall_id')
           ->where('movies.id', '=', $data['movie'])->get();

   } elseif (isset($data['type_movie'][0]) && !is_null($data['date'])){
       return DB::table('time_tables')->join('movies', 'movies.id', '=', 'time_tables.movie_id')
           ->join('halls', 'halls.id', '=', 'time_tables.hall_id')
           ->where('movies.type_movie', 'like', '%' . $data['type_movie'][0] .'%')
           ->where('time_tables.date', '=', Carbon::parse($data['date'])->format('Y-m-d'))->get();

   } elseif (isset($data['type_movie'][0]) && isset($data['hall'])){
       return DB::table('time_tables')->join('movies', 'movies.id', '=', 'time_tables.movie_id')
           ->join('halls', 'halls.id', '=', 'time_tables.hall_id')
           ->where('movies.type_movie', 'like', '%' . $data['type_movie'][0] .'%')
           ->where('time_tables.hall_id', '=', $data['hall'])->get();
   }




      // return DB::table('time_tables')->join('movies', 'movies.id', '=', 'time_tables.movie_id')
      //     ->join('halls', 'halls.id', '=', 'time_tables.hall_id')
      //     ->where('movies.type_movie', 'like', '%' . $data['type_movie'][0] .'%')
      //     ->where('time_tables.movie_id', '=', $data['cinema'])
      //     ->where('time_tables.date', '=', $data['date'])
      //     ->where('time_tables.hall_id', '=', $data['hall'])
      //     ->get();


    }

    public function getfilterType(array $data){


            return DB::table('time_tables')->join('movies', 'movies.id', '=', 'time_tables.movie_id')
                ->join('halls', 'halls.id', '=', 'time_tables.hall_id')
                ->where('movies.type_movie', 'like', '%' . $data['type_movie'][0] .'%')->get();



    }

}

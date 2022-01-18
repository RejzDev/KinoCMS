<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use DateTimeZone;

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

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TimeTable extends Model
{
    use HasFactory;

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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function time_tables()
    {
        return $this->hasMany(TimeTable::class,'time_table_id');
    }

    public function create(array $booking){
        $this->insert($booking);

        return 1;

    }

    public function getBooking(int $time_table_id){
        return $this->where('time_table_id', '=', $time_table_id)->get();
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use DateTimeZone;
use function PHPUnit\Framework\isEmpty;

class CountVisit extends Model
{
    use HasFactory;

    public function saveCountVisit(){

        $datet = Carbon::parse(Carbon::now(new DateTimeZone('Europe/Kiev')))->format('Y-m-d');

        $dates = CountVisit::where('created_at', 'LIKE', '%' . $datet . '%')->get();

    if ($dates) {
        foreach ($dates as $date) {
            if (Carbon::parse($date->created_at)->format('Y m d') == Carbon::parse(Carbon::now(new DateTimeZone('Europe/Kiev')))->format('Y m d')) {
                $date->count_visit = $date->count_visit + 1;
                $date->update();

                return 'up';
            } else {

                return 'new';
            }
        }
    }

        $this->count_visit = 1;
        $this->created_at =  Carbon::parse(Carbon::now(new DateTimeZone('Europe/Kiev')));

        $this->save();

return 'new';
    }

    public function getCount(){
          $count = CountVisit::select('count_visit')->orderBy('created_at', 'desc')->limit(3)->get();


        return $count;
    }


}

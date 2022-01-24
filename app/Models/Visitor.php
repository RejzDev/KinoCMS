<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use http\Env\Request;
use Illuminate\Support\Carbon;
use DateTimeZone;
use function PHPUnit\Framework\isEmpty;

class Visitor extends Model
{
    use HasFactory;

    public function saveVisitor($data) {

        $datet = Carbon::parse(Carbon::now(new DateTimeZone('Europe/Kiev')))->format('Y-m-d');


        $visitors = Visitor::where('date_visitors', 'LIKE', '%' . $datet . '%')->where('ip', '=', $data['ip'])->get()->toArray();

        $countVisit = new CountVisit();


        if ($visitors){
            return 'gg';
        } else{
            $this->ip = $data['ip'];
            $this->user_agent = $data['userAgent'];
            $this->date_visitors = Carbon::now(new DateTimeZone('Europe/Kiev'));


            $this->save();

            $count = $countVisit->saveCountVisit();


            $result = 'gh';
        }


      //$countVisit = new CountVisit();

      // if ($visitors) {
      //     foreach ($visitors as $visitor) {
      //         if (Carbon::parse($visitor->date_visitors)->format('Y m d') == Carbon::parse(Carbon::now(new DateTimeZone('Europe/Kiev')))->format('Y m d') ) {

      //             $result = 'gg';
      //         } else {
      //             $this->ip = $data['ip'];
      //             $this->user_agent = $data['userAgent'];
      //             $this->date_visitors = Carbon::now(new DateTimeZone('Europe/Kiev'));


      //             $this->save();

      //             $count = $countVisit->saveCountVisit();
      //             dd($count);

      //             $result = 'gh';
      //         }
      //     }
      // } else{
      //     $this->ip = $data['ip'];
      //     $this->user_agent = $data['userAgent'];
      //     $this->date_visitors = Carbon::now(new DateTimeZone('Europe/Kiev'));


      //     $this->save();

      //     $count = $countVisit->saveCountVisit();
      //     dd($count);

      //     $result = 'gh';
      // }



        return $result;
    }

}

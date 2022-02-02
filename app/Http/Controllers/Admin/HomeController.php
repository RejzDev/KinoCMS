<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use DateTimeZone;
use App\Models\CountVisit;
use Jenssegers\Agent\Facades\Agent;
use App\Models\Visitor;

class HomeController extends Controller
{
    public function index ()
    {
        $users = new User();
        $visitors = new Visitor();
        $visit = new CountVisit();

        $user = $users->getUsers();

        $data['pie'] = $users->getStatistic();

        $counts = $visit->getCount();

        foreach ($counts as $count){
            $data['line'][] = $count['count_visit'];
        }

        $countUsers = 0;
        foreach ($user as $item) {
            if ($item->isOnline()) {
                $countUsers++;
            }

        }

        $browser['Firefox'] = 0;
        $browser['Chrome'] = 0;
        $visitor = $visitors->getAll();


        foreach ($visitor as $item){
            if ($item['browser'] == 'Firefox'){
                $browser['Firefox'] +=1;
            }
            else if ($item['browser'] == 'Chrome'){
                $browser['Chrome'] +=1;
            }
        }



        return view('admin.home.index', ['user' => $user,
            'data' => $data,
            'countUsers' => $countUsers,
            'browser'=>$browser]);
    }
}

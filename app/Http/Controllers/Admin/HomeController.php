<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use DateTimeZone;
use App\Models\CountVisit;

class HomeController extends Controller
{
    public function index ()
    {
        $users = new User();
        $visit = new CountVisit();

        $user = $users->getUsers();

        $data['pie'] = $users->getStatistic();

        $counts = $visit->getCount();

        foreach ($counts as $count){
            $data['line'][] = $count['count_visit'];
        }



        return view('admin.home.index', ['user' => $user,
            'data' => $data]);
    }
}

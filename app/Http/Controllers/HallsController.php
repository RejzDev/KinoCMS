<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cinema;
use App\Models\Page;
use App\Models\TimeTable;
use App\Models\Hall;

class HallsController extends Controller
{
    public function index($id)
    {
        $halls = new Hall();
        $timeTable = new TimeTable();
        $data = $halls->getHallIds($id);

        $timeTables = $timeTable->getOngoingToday();



        return view('hall.page', ['data' => $data,  'timeTable' => $timeTables]);
    }
}

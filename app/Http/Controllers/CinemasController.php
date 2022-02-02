<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cinema;
use App\Models\Page;
use App\Models\TimeTable;

class CinemasController extends Controller
{
    public function index($id)
    {
        $cinema = new Cinema();
        $page = new Page();
        $timeTable = new TimeTable();
        $data = $cinema->getCinemaIds($id);
        $pages = $page->getPages($id);
        $timeTables = $timeTable->getOngoingToday();



        return view('cinema.page', ['data' => $data, 'page' => $pages, 'timeTable' => $timeTables]);
    }
}

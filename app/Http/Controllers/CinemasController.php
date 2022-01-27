<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cinema;

class CinemasController extends Controller
{
    public function index($id)
    {
        $cinema = new Cinema();
        $data = $cinema->getCinemaIds($id);


        return view('cinema.page', ['data' => $data]);
    }
}

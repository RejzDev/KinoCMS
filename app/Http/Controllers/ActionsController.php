<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;

class ActionsController extends Controller
{
    //

    public function index($id)
    {
        $action = new Action();
        $data = $action->getActionIds($id);




        return view('cinema.page', ['data' => $data]);
    }
}

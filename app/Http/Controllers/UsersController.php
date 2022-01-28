<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UsersController extends Controller
{
    public function index($id)
    {
        $user = new User();
        $data = $user->getUserIds($id);




        return view('actions.page', ['data' => $data]);
    }
}

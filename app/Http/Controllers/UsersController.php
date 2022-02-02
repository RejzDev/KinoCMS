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




        return view('user.index', ['user' => $data]);
    }

    public function update(Request $request, $id)
    {
        $users = new User();
        $user = $users->getUserIds($id);
        $data = $request->all();

        $user->updates($data, $user);

        return redirect(route('users.page', $id));

    }
}

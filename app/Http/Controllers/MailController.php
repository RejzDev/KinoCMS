<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailMail;
use App\Models\User;

class MailController extends Controller
{
    public function send(Request $request)
    {


        if ($request->allUser == 'on'){
            $users = User::all();


        }

        if ($request->User == 'on'){
            $usersId = $request->session()->pull('user');
            $users = User::whereIn('id', $usersId)
                ->get();

        }


        foreach ($users as $user){
            $comment = 'Helow' . $user['íd'] . $user['name'];

            $toMail = $user['email'];

            Mail::to($toMail)->send(new EmailMail($comment));

        }
          }

    public function index()
    {
        return view('admin.mail.index');
    }

    public function mailUsers()
    {
        $users = User::all();

        return view('admin.mail.user', compact('users'));
    }

    public function saveUser(Request $request)
    {

        foreach ($request->User as $user){
            $usersId[] = $user;
        }


      //  $users = User::whereIn('id', $usersId)
      //      ->get();
//

        $request->session()->put('user', $usersId);
        return redirect(route('mail.index'));
    }
}

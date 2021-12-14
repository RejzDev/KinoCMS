<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailMail;

class MailController extends Controller
{
    public function send()
    {
        $comment = 'test';

        Mail::to('yijid34783@kingsready.com')->send(new EmailMail($comment));
    }
}

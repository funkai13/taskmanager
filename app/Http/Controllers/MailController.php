<?php

namespace App\Http\Controllers;

use App\Mail\Welcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendWelcomeMail(Request $request): void
    {
        Mail::to('fake@mail.com')->send(new Welcome());
        printf('TEST');
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => 'Demo Mail from Jackson Kishan',
            'body' => 'This is a test email from Jackson Kishan'
        ];

        Mail::to('jackson.kishan56@gmail.com')->queue(new DemoMail());

        // return redirect()->back()->with('success', 'Email has been sent.');
       dd('Email has been sent.');
    }
}

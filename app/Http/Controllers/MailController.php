<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Request $request): Application|Redirector|RedirectResponse
    {
        $details = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'message' => $request->get('message')
        ];

        Mail::to(env('MAIL_SEND_TO'))->send(new SendMail($details));

        return redirect('/contact')->with('success', 'Email enviado');
    }
}

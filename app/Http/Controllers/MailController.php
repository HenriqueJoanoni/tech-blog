<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Services\HtmlPurifierService;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail(Request $request): Application|Redirector|RedirectResponse
    {
        $details = $this->validateEntries($request->only(['name', 'email', 'subject', 'message']));

        Mail::to(env('MAIL_SEND_TO'))->send(new SendMail($details));

        return redirect('/contact')->with('success', 'Email sent');
    }

    private function validateEntries(array $data): array
    {
        $purifier = HtmlPurifierService::getInstance();
        return [
            'name' => htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8'),
            'email' => filter_var($data['email'], FILTER_SANITIZE_EMAIL),
            'subject' => htmlspecialchars($data['subject'], ENT_QUOTES, 'UTF-8'),
            'message' => $purifier->purify($data['message'])
        ];
    }
}

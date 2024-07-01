<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'message' => 'required|string|max:2000',
        ]);

        Mail::to(Config::get('mail.contact_mail'))->send(new ContactUs(
            $request->get('first_name'),
            $request->get('last_name'),
            $request->get('email'),
            $request->get('message'),
        ));

        return Redirect::route('contact.success')
            ->with('first_name', $request->get('first_name'));
    }
}

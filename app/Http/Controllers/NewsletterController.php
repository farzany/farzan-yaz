<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MailchimpMarketing\ApiClient;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $mailchimp = new ApiClient();
    
        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us17'
        ]);
        
        try {
            $mailchimp->lists->addListMember(config('services.mailchimp.list'), [
                'email_address' => $request->input('email'),
                'status'        => 'pending',
            ]);
        } catch (\Exception $exception) {
            session()->flash('error', "The provided email address is invalid.");
    
            throw ValidationException::withMessages([
                'email' => 'The email must be a valid email address.',
            ]);
        }
    
        return redirect('posts')->with('success', "You've subscribed to the newsletter! Check your email to confirm.");
    }
}

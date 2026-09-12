<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Store a new contact message and notify the site owner.
     */
    public function store(ContactRequest $request): RedirectResponse
    {
        // Bots fill in every field, including the ones hidden from
        // real visitors with CSS. Pretend success and do nothing.
        if ($request->isSpam()) {
            return redirect()
                ->back()
                ->with('success', 'Thanks for reaching out. I will get back to you soon.');
        }

        $contactMessage = ContactMessage::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'message' => $request->validated('message'),
            'ip_address' => $request->ip(),
        ]);

        Mail::to(config('portfolio.contact_email'))
            ->queue(new ContactMessageReceived($contactMessage));

        return redirect()
            ->back()
            ->with('success', 'Thanks for reaching out. I will get back to you soon.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactNotification;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact', [
            'metaTitle' => __('site.nav.contact').' | '.config('hala.site_name'),
            'metaDescription' => __('site.seo.contact_desc'),
        ]);
    }

    public function submit(ContactRequest $request)
    {
        $contact = ContactMessage::create([
            'name' => $request->string('name')->toString(),
            'email' => $request->string('email')->toString(),
            'phone' => $request->string('phone')->toString() ?: null,
            'country' => $request->string('country')->toString() ?: null,
            'message' => $request->string('message')->toString(),
            'meta' => [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'path' => $request->path(),
            ],
        ]);

        $to = config('hala.contact_notify_to');
        if ($to) {
            try {
                Mail::to($to)->send(new ContactNotification($contact));
            } catch (\Throwable $e) {
                // Keep user experience smooth even if mail isn't configured.
            }
        }

        return redirect()->route('contact')->with('success', __('site.contact.success'));
    }
}

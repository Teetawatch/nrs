<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfo = ContactInfo::all()->keyBy('key');
        return view('pages.contact.index', compact('contactInfo'));
    }

    public function send(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        $msg = ContactMessage::create($validated);

        $adminEmail = env('CONTACT_MAIL_TO');
        if ($adminEmail) {
            try {
                Mail::raw(
                    "ข้อความติดต่อใหม่จาก: {$msg->name} <{$msg->email}>\n\nเรื่อง: {$msg->subject}\n\n{$msg->message}",
                    fn ($m) => $m->to($adminEmail)->subject("[ติดต่อ] {$msg->subject}")
                );
            } catch (\Throwable) {
            }
        }

        return back()->with('success', 'ขอบคุณที่ติดต่อมา เราจะตอบกลับโดยเร็วที่สุด');
    }
}

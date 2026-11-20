<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(StoreContactMessageRequest $request)
    {
        $validated = $request->validated();

        ContactMessage::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'subject' => $validated['subjek'],
            'message' => $validated['pesan'],
        ]);

        return redirect()->route('contact')
            ->with('success', 'Pesan berhasil dikirim! Terima kasih telah menghubungi RuangRona.');
    }
}
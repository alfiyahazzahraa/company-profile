<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $messages = ContactMessage::when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        })->latest()->get();

        $unreadCount = ContactMessage::where('status', 'Belum dibaca')->count();
        $readCount = ContactMessage::where('status', 'Dibaca')->count();
        $repliedCount = ContactMessage::where('status', 'Sudah dibalas')->count();

        return view('admin.messages.index', compact(
            'messages',
            'unreadCount',
            'readCount',
            'repliedCount',
            'search'
        ));
    }

    public function update(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Belum dibaca,Dibaca,Sudah dibalas'],
        ]);

        $message->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.messages.index')
            ->with('success', 'Status pesan berhasil diperbarui.');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
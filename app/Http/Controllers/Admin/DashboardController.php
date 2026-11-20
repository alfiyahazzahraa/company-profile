<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMessages = ContactMessage::count();

        $newMessages = ContactMessage::where('status', 'Belum dibaca')->count();

        $processedMessages = ContactMessage::where('status', 'Dibaca')->count();

        $completedMessages = ContactMessage::where('status', 'Sudah dibalas')->count();

        $recentMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalMessages',
            'newMessages',
            'processedMessages',
            'completedMessages',
            'recentMessages'
        ));
    }
}

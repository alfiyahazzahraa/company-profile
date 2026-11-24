<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik pesan
        $totalMessages = ContactMessage::count();

        $newMessages = ContactMessage::where('status', 'Belum dibaca')->count();

        $processedMessages = ContactMessage::where('status', 'Dibaca')->count();

        $completedMessages = ContactMessage::where('status', 'Sudah dibalas')->count();

        $recentMessages = ContactMessage::latest()->take(5)->get();

        // Statistik layanan dan portofolio
        $totalServices = Service::count();

        $totalPortfolios = Portfolio::count();

        // Statistik artikel WordPress
        $wordpressResponse = Http::timeout(5)->get(
            'http://localhost/wordpress-cms/wp-json/wp/v2/posts',
            [
                'per_page' => 1,
            ]
        );

        $totalPosts = $wordpressResponse->successful()
            ? (int) $wordpressResponse->header('X-WP-Total', 0)
            : 0;

        return view('admin.dashboard', compact(
            'totalMessages',
            'newMessages',
            'processedMessages',
            'completedMessages',
            'recentMessages',
            'totalServices',
            'totalPortfolios',
            'totalPosts'
        ));
    }
}


<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\PostController;


// Homepage User
Route::get('/', [HomeController::class, 'index']);


// Kontak
Route::get('/kontak', [ContactController::class, 'index'])
    ->name('contact');

Route::post('/kontak', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');


// Login Admin
Route::get('/admin/login', [LoginController::class, 'index'])
    ->name('admin.login');

Route::post('/admin/login', [LoginController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('admin.login.store');

Route::post('/admin/logout', [LoginController::class, 'logout'])
    ->name('admin.logout');


// ADMIN
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        //Halaman 
        Route::resource('pages', PageController::class)
            ->except(['show']);

        //Sliders
        Route::resource('sliders', SliderController::class)
            ->except(['show']);

        //Team
        Route::resource('team', TeamMemberController::class)
            ->except(['show']);

        // Services CRUD
        Route::resource('services', ServiceController::class)
            ->except(['show']);


        // Portfolio CRUD
        Route::resource('portfolios', PortfolioController::class)
            ->except(['show']);


        // Categories CRUD
        Route::resource('categories', CategoryController::class)
            ->except(['show']);

        // Posts CRUD
        Route::resource('posts', PostController::class)
            ->except(['show']);

        // Testimonials CRUD
        Route::resource('testimonials', TestimonialController::class)
            ->except(['show']);

        // Client CRUD
        Route::resource('clients', ClientController::class)
            ->except(['show']);

        // Inbox
        Route::get('/messages', [ContactMessageController::class, 'index'])
            ->name('messages.index');

        Route::patch('/messages/{message}', [ContactMessageController::class, 'update'])
            ->name('messages.update');

        Route::delete('/messages/{message}', [ContactMessageController::class, 'destroy'])
            ->name('messages.destroy');


        // Settings
        Route::get('/settings', [SettingController::class, 'edit'])
            ->name('settings.edit');

        Route::patch('/settings', [SettingController::class, 'update'])
            ->name('settings.update');


        // Profile
        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::patch('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::delete('/profile', [ProfileController::class, 'destroy'])
            ->name('profile.destroy');

    });


// Tes integrasi WordPress Headless CMS
Route::get('/wordpress-api-test', function () {
    $response = Http::get('http://localhost/wordpress-cms/wp-json/wp/v2/posts');

    return $response->json();
});


// Halaman berita dari WordPress
Route::get('/berita-wordpress', function () {
    $response = Http::get(
        'http://localhost/wordpress-cms/wp-json/wp/v2/posts?_embed'
    );

    $posts = $response->successful()
        ? $response->json()
        : [];

    return view('wordpress-news', compact('posts'));
});


// Detail berita dari WordPress
Route::get('/berita-wordpress/{slug}', function ($slug) {
    $response = Http::get(
        'http://localhost/wordpress-cms/wp-json/wp/v2/posts',
        [
            'slug' => $slug,
            '_embed' => true,
        ]
    );

    $posts = $response->successful()
        ? $response->json()
        : [];

    $post = $posts[0] ?? null;

    if (!$post) {
        abort(404);
    }

    return view('wordpress-detail', compact('post'));
});

Route::get('/wordpress-auth-test', function () {
    $response = \Illuminate\Support\Facades\Http::withBasicAuth(
        config('wordpress.username'),
        config('wordpress.password')
    )->get(config('wordpress.api_url') . '/posts');

    return response()->json([
        'status' => $response->status(),
        'connected' => $response->successful(),
        'message' => $response->successful()
            ? 'Laravel berhasil terhubung ke WordPress!'
            : 'Koneksi gagal.',
    ]);
});

Route::get('/wordpress-service-test', function (\App\Services\WordPressService $wordpress) {
    $response = $wordpress->getPosts();

    return response()->json([
        'status' => $response->status(),
        'connected' => $response->successful(),
        'posts' => $response->json(),
    ]);
});

// Breeze Auth Routes
require __DIR__.'/auth.php';

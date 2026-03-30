<?php

use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Livewire\Actions\Logout;
use   Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Livewire\Admin\Login;
// Route::view('/', 'welcome', [
//     'canRegister' => Features::enabled(Features::registration()),
// ])->name('home');
// Route::get('login', function () {
//     return view('/login', 'livewire.auth.user-login');
// })->name('login');
// Route::get('admin/login', function () {
//     return view('/admin/login', 'livewire.admin.admin-login');
// })->name('admin.login');
 // Route::redirect('admin/login', 'admin.admin-login');
// Route::view('/login', 'components.auth.user-login')->name('login');
// Route::view('/admin/login', 'components.admin.admin-login')->name('admin.login');

// Route::get('/admin/dashboard', function () {
//     return "Admin Dashboard";
// })->middleware('auth:admin')->name('admin.dashboard');
Route::post('/logout/{guard}', Logout::class);
// Protected routes
Route::middleware('auth:web')->group(function () {
    Route::view('/dashboard', 'Frontend.home.index')->name('dashboard');
});

Route::middleware('auth:admin')->group(function () {
    Route::view('/admin/dashboard', 'Admin.dashboard')->name('admin.dashboard');
});
Route::prefix('{current_team}')
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

    Route::prefix('admin')->group(function () {

        Route::get('/login', Login::class)->name('admin.login');


    });

Route::middleware(['auth'])->group(function () {
    Route::livewire('invitations/{invitation}/accept', 'pages::teams.accept-invitation')->name('invitations.accept');
});

Route::get('/', function () {
    return view('Frontend.home.index');
})->name('/');
Route::get('index', function () {
    return view('Frontend.home.index');
})->name('index');

Route::get('about', function () {
    return view('Frontend.about.index');
})->name('about');

Route::get('blog', function () {
    return view('Frontend.blog');
})->name('blog');

Route::get('blog-detail', function () {
    return view('Frontend.blog-detail');
})->name('blog-detail');

Route::get('contact', function () {
    return view('Frontend.contact.index');
})->name('contact');

Route::get('product', function () {
    return view('Frontend.product.index');
})->name('product');

Route::get('product-detail', function () {
    return view('Frontend.product.details');
})->name('product-detail');

Route::get('cart', function () {
    return view('Frontend.cart.index');
})->name('cart');

Route::get('checkout', function () {
    return view('Frontend.checkout.index');
})->name('checkout');

require __DIR__.'/settings.php';
Route::post('/logout', function () {

    if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
        return redirect('/login');
    }

    Auth::guard('web')->logout();
    return redirect('/login');

})->name('logout');
Route::get('/home', function () {
    return redirect('/dashboard');
})->name('home');
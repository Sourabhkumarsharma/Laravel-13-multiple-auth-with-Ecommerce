<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(string $guard = 'web')
    {
        Auth::guard($guard)->logout();

        Session::regenerateToken();

        return redirect(
            $guard === 'admin' ? '/admin/login' : '/login'
        );
        Session::invalidate();
        
        Session::regenerateToken();

        return redirect('/');
    }
}

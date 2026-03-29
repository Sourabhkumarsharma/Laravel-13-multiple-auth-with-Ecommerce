<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ IMPORTANT
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
class Admin extends Authenticatable // ✅ MUST extend this
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
      public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
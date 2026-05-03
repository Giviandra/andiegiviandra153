<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // 1. Tambahkan baris ini
use App\Models\User;                 // 2. Tambahkan baris ini

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 3. Tambahkan definisi Gate ini
        Gate::define('isAdmin', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
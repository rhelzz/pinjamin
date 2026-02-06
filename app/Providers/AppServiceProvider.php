<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share unread notification count with all views
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $unreadCount = \App\Models\Notifikasi::where('user_id', Auth::id())
                    ->where('is_read', false)
                    ->count();
                $view->with('unreadNotifikasiCount', $unreadCount);
            }
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

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
        $statuses = [
            '0' => Storage::disk('public')->exists('template/template_laporan_0.pdf'),
            '50' => Storage::disk('public')->exists('template/template_laporan_50.pdf'),
            '100' => Storage::disk('public')->exists('template/template_laporan_100.pdf'),
        ];
        
        View::share('statuses', $statuses);
    }
}

<?php

namespace App\Providers;

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
        \Filament\Facades\Filament::registerNavigationGroups([
            'Master Data' => 40,
            'Transaksi' => 30,
            'Laporan' => 20,
            'Pengaturan' => 10,
        ]);
    }
}

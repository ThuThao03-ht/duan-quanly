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
        // Observers for Realtime Backup
        \App\Models\PurchaseRequest::observe(\App\Observers\BackupObserver::class);
        \App\Models\PrTimeline::observe(\App\Observers\BackupObserver::class);
        \App\Models\Department::observe(\App\Observers\BackupObserver::class);
        // Notes might be relevant too if they are critical
        // \App\Models\Note::observe(\App\Observers\BackupObserver::class); 
    }
}

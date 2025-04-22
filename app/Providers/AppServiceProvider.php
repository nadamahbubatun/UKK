<?php

namespace App\Providers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Models\Task;


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
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $today = Carbon::today();
                $threshold = $today->copy()->addDays(3);
                
                $notifications = Task::where('user_id', Auth::id())
                    ->whereNotNull('end_date')
                    ->whereBetween('end_date', [$today, $threshold])
                    ->whereIn('status', ['Belum Selesai', 'On Progress'])
                    ->get();
                
    
                $view->with('notifications', $notifications);
            }
        });
    }
}
<?php

namespace App\Providers;

use App\Models\BackPanel\AboutUs;
use App\Models\BackPanel\Service;
use App\Models\BackPanel\SiteSetting;
use App\Models\BackPanel\TeamCategory;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        View::composer(['*'], function ($view) {
            $view->with('userProfile', Auth::user());
            $view->with('siteSetting', SiteSetting::find(1));
            $view->with('aboutus', AboutUs::find(1));
            $view->with('teamcategory', TeamCategory::where('status', "Y")->get());
            $view->with('services', Service::where('status', "Y")->orderBy('order', 'asc')->take(4)->get());
        });

        // Use Bootstrap for Pagination
        \Illuminate\Pagination\Paginator::useBootstrap();
    }
}

<?php

namespace App\Providers;

use App\Services\HelperService;
use App\Services\MenuService;
use App\Services\ProductService;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // dd(Session::get('locale'));


        View::composer(['front.*'], function ($view) {
            $view->with('user', Auth::user());
        });
      
        $obj = new SettingsService();
        view()->share('settings', $obj->list());
    
    }
}
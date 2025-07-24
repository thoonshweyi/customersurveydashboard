<?php

namespace App\Providers;

use App\Models\Branch;
use Illuminate\Pagination\Paginator;
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
        View::composer('*',function($view){
            $branches = Branch::where("status_id",'1')->get();
            $view->with("userdata",Auth::user())->with("branches",$branches);
        });

        Paginator::useBootstrapFive();
    }
}

<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share categories across all views
        View::composer('*', function ($view) {
            $categories = Category::all();
            $view->with('categories', $categories);
        });
    }

    public function register()
    {
        //
    }
}


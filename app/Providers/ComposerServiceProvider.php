<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\CategorysFlont;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layout/index', function ($view) {
            $results = CategorysFlont::all();
            $view->with('side_categorys', $results);
        });
    }
}

<?php
namespace App\Providers;
 
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\ACategory;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layout/index', function($view) {
            $results = ACategory::all();
            $view->with('side_categorys', $results);
        });
    }

}
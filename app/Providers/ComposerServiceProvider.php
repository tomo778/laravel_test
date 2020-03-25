<?php
namespace App\Providers;
 
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layout/index', function($view) {
            $results = Category::select('m_category.id','m_category.title')
            ->JoinCategory()
            ->JoinCategoryProduct()
            ->StatusCheck()
            ->where('r_category.plugin', 'product')
            ->groupBy('m_category.id')
            ->orderBy('m_category.id','asc')
            ->get();
            $view->with('side_categorys', $results);
        });
    }

}
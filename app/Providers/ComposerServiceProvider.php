<?php
namespace App\Providers;
 
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use DB;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('layout/index', function($view) {
            // $results = DB::table('m_category')
            // ->select('m_category.id','m_category.title')
            // ->leftJoin('r_category','r_category.category_id','=','m_category.id')
            // ->leftJoin('m_news','m_news.id','=','r_category.plugin_id')
            // ->where('m_news.status', config('const.STATUS_ON'))
            // ->where('r_category.plugin', 'news')
            // ->groupBy('m_category.id')
            // ->orderBy('m_category.id','desc')
            // ->get()->keyBy('id')->toArray();
            
            $results = DB::table('m_category')
            ->select('m_category.id','m_category.title')
            ->orderBy('m_category.id','desc')
            ->get()->keyBy('id')->toArray();
            $view->with('side_categorys', $results);
        });
    }

}
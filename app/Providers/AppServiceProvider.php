<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libs\Breadcrumbs;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind('Breadcrumbs', Breadcrumbs::class);

        // // .envを見てログ出力を行うかどうかを判別
        // if (env('APP_DEBUG') !== true) {
        // 	return;
        // }
        // // SQL Log
        // \DB::listen(function ($query) {
        // 	$sql = $query->sql;
        // 	for ($i = 0; $i < count($query->bindings); $i++) {
        // 		$sql = preg_replace("/\?/", $query->bindings[$i], $sql, 1);
        // 	}

        // 	// SQL Log
        // 	//\Log::debug("SQL", ["time" => sprintf("%.2f ms", $query->time), "sql" => $sql]);
        // 	//log
        // 	$LogCustom = new LogCustom('sql');
        // 	$mes = sprintf("%.2f ms", $query->time) . ', "' . $sql . '"';
        // 	$LogCustom->daily('/logs/sql/sql.log', $mes);
        // });
    }
}

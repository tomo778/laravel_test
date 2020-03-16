<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use App\Services\LoggerCustom;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		// SQL Log
		\DB::listen(function ($query) {
			$sql = $query->sql;
			for ($i = 0; $i < count($query->bindings); $i++) {
				$sql = preg_replace("/\?/", $query->bindings[$i], $sql, 1);
			}

			// SQL Log
			//\Log::debug("SQL", ["time" => sprintf("%.2f ms", $query->time), "sql" => $sql]);
			//log
			$LoggerCustom = new LoggerCustom('sql');
			$mes = sprintf("%.2f ms", $query->time) . ', "' . $sql . '"';
			$LoggerCustom->daily('/logs/sql/sql.log', $mes);

		});
		//
		$this->app->bind('AdminLogin','App\Services\AdminLogin');
	}
}

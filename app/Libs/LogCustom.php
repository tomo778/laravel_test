<?php
namespace app\Libs;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;

class LogCustom
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	protected $log = '';

	public function __construct($name)
 	{
 		$this->log = new Logger($name);
 	}

	public function single($path, $mes)
	{
		// SQL Log カスタム（1ファイル）
		$this->log->pushHandler(new StreamHandler(storage_path() . $path, config('app.log_level')));
		$this->log->addInfo($mes);
	}

	public function daily($path, $mes)
	{
		// SQL Log カスタム（日別）
		$this->log->pushHandler(new RotatingFileHandler(storage_path() . $path, config('app.log_max_files'), config('app.log_level')));
		$this->log->addInfo($mes);
	}
}

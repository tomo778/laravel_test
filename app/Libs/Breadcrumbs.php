<?php

namespace app\Libs;

class Breadcrumbs
{
	static public $array = array();

	static public function push($text, $url = null)
	{
		self::$array[$url] = $text;
	}

	static public function get()
	{
		return self::$array;
	}
}

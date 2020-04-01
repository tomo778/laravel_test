<?php

namespace app\Libs;

class Breadcrumbs
{
	public $array = array();

	public function push($text, $url = null)
	{
		$this->array[$url] = $text;
	}

	public function get()
	{
		return $this->array;
	}
}

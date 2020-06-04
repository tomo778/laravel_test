<?php

namespace app\Libs;

class Breadcrumbs
{
    public static $array = array();

    public static function push($text, $url = null)
    {
        self::$array[$url] = $text;
    }

    public static function get()
    {
        return self::$array;
    }
}

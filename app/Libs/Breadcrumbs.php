<?php

namespace app\Libs;

class Breadcrumbs
{
    public static $array = array();

    public static function push(String $text, String $url = null): void
    {
        self::$array[$url] = $text;
    }

    public static function get(): Array
    {
        return self::$array;
    }
}

<?php

namespace app\Libs;

class Breadcrumbs
{
    public static $array = array();

    /**
     * パンくずリスト追加
     *
     * @param String テキスト
     * @param String リンク先
     * @return void
     */
    public static function push(String $text, String $url = null): void
    {
        self::$array[$url] = $text;
    }

    /**
     * パンくず配列取得
     *
     * @return array
     */
    public static function get(): array
    {
        return self::$array;
    }
}

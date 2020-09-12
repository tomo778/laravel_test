<?php

namespace app\Libs;

class Common
{
    /**
     * フリーワード検索のqueryを追加する
     *
     * @param Object $query
     * @param string 検索文字列
     * @param array 検索対象カラム
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public static function fw_search(Object $query, string $s, array $tmp2): \Illuminate\Database\Eloquent\Builder
    {
        $tmp = array();
        $tmp = mb_convert_kana($s, "s", "UTF-8");
        $tmp = trim($tmp);
        $tmp = explode(" ", $tmp);
        $tmp = array_filter($tmp);
        foreach ($tmp as $key => $value) {
            $query->where(
                function ($query) use ($value, $tmp2) {
                    foreach ($tmp2 as $key2 => $value2) {
                        $query->orwhere($value2, 'like', '%' . $value . '%');
                    }
                }
            );
        }
        return $query;
    }

    /**
     * 購入idの一部を作成
     *
     * @param int 桁数
     * @return String $number
     */
    public static function randInt(int $num): String
    {
        $number = '';
        for ($i = 0; $i < $num; $i++) {
            $number .= rand(0, 9);
        }
        return $number;
    }
}

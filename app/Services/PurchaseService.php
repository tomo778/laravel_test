<?php

namespace app\Services;

use Illuminate\Database\DatabaseManager;
use App\Models\Product;

class PurchaseService
{
    protected $db;
    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    public function decrementQuantity()
    {
        $cart_items = session('cart');
        foreach ($cart_items['items'] as $k => $v) {
            $tmp[] = $v['id'];
        }
        $db_items = Product::lockForUpdate()
            ->whereIn('id', $tmp)
            ->get()
            ->toArray();
        foreach ($db_items as $k => $v) {
            $quantity = $cart_items['items'][$v['id']]['quantity'];
            if ($v['num'] < $quantity) {
                return false;
            }
        }
        //商品残りがある場合
        foreach ($cart_items['items'] as $k => $v) {
            Product::where('id', $k)
                ->decrement('num', $v['quantity']);
        }
        return true;
    }
}

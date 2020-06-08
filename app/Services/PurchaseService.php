<?php

namespace app\Services;

use Illuminate\Database\DatabaseManager;
use App\Models\Product;
use App\Models\UsersHistory;
use App\Libs\Common;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PurchaseService
{
    protected $db;
    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    public function quantityCheck(): bool
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
        return true;
    }

    public function decrementQuantity(): bool
    {
        $cart_items = session('cart');
        foreach ($cart_items['items'] as $k => $v) {
            Product::where('id', $k)
                ->decrement('num', $v['quantity']);
        }
        return true;
    }

    public function addOrderHistory()
    {
        $session_purchase = session('purchase');
        $cart_items = session('cart');
        foreach ($cart_items['items'] as $k => $v) {
            $tmp['user_id'] = $session_purchase['user_id'];
            $tmp['order_id'] = $session_purchase['order_id'];
            $tmp['title'] = $v['title'];
            $tmp['price'] = $v['price'];
            $tmp['quantity'] = $v['quantity'];
            $tmp['updated_at'] = $session_purchase['date'];
            $tmp['created_at'] = $session_purchase['date'];
            $data[] = $tmp;
        }
        UsersHistory::insert($data);
    }
}

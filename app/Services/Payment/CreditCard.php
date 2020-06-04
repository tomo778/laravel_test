<?php

namespace App\Services\Payment;

//use App\Services\Payment\Payway;

class CreditCard implements PayWay
{
    public function execute()
    {
        // クレジットカードの場合の決済処理を書いていく
        return true;
    }
}

<?php

namespace App\Services\Payment;
use Illuminate\Http\Request;

class PaymentFactory
{
  public static function create()
  {
    $purchase = session('purchase');
    if ($purchase['payway'] == Config('const.PAYWAY_DELIVERY')) {
        $klass = new \App\Services\Payment\del;
    }
    if ($purchase['payway'] == Config('const.PAYWAY_CARD')) {
        $klass = new \App\Services\Payment\CreditCard;
    }
    //request()->get('payway')
    //if (empty($klass)) {
      //throw new \Exception('invalid payway');
    //}
    return $klass;
  }
}

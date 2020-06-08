<?php

namespace App\Http\Controllers;

use App\Services\Payment\PaymentFactory;
use DB;
use App\Services\PurchaseService;
use App\Services\UsersAddressService;
use App\Models\UsersAddress;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseMail;
use App\Libs\Common;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    private $purchaseService;
    private $usersAddressService;

    public function __construct(PurchaseService $purchaseService, UsersAddressService $usersAddressService)
    {
        $this->middleware('auth');
        $this->purchaseService = $purchaseService;
        $this->usersAddressService = $usersAddressService;
    }

    public function index()
    {
        $data = [
            'data' => $this->usersAddressService->list(),
        ];
        return view('purchase.contact', $data);
    }

    public function back()
    {
        $data = [
            'data' => $this->usersAddressService->list(),
            'Request' => session('purchase'),
        ];
        return view('purchase.contact', $data);
    }

    public function confirm(PurchaseRequest $Request)
    {
        session(['purchase' => $Request->all()]);
        $data = [
            'address' => $this->usersAddressService->detail($Request->address),
            'Request' => session('purchase'),
            'cart' => session('cart'),
            'payway' => Config('const.payway')
        ];
        return view('purchase.confirm', $data);
    }

    public function finish()
    {
        $this->addSessionData();
        $this->purchase();
        $this->sendMail();
        $this->purchaseService->addOrderHistory();
        $this->saveSession();
        return view('purchase.finish');
    }

    private function purchase()
    {
        DB::transaction(function () {
            //商品個数管理
            if ($this->purchaseService->quantityCheck() == false) {
                DB::rollBack();
                return view('purchase.err_quantity');
            };
            $this->purchaseService->decrementQuantity();
            //決済処理
            $payment = PaymentFactory::create();
            $payment->execute();
        });
    }

    private function sendMail()
    {
        $bcc = 'bcc@mail.com';
        Mail::to(Auth::user()->email)
            //->cc($cc)
            //->bcc($bcc)
            ->send(new PurchaseMail());
    }

    private function addSessionData()
    {
        $date = Carbon::now();
        //
        $session = session('purchase');
        $session['date'] = $date;
        $session['address_datas'] = $this->usersAddressService->detail($session['address']);
        $session['user_id'] = Auth::id();
        $session['user_name'] = Auth::user()->name;
        $session['order_id'] = Common::randInt(5) . $date->format('-Ymd-His');
        session(['purchase' => $session]);
    }

    private function saveSession()
    {
        session()->regenerateToken();
        session()->forget('cart');
        session()->forget('purchase');
    }
}

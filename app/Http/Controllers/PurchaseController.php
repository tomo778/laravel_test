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
use App\Exceptions\PurchaseException;

class PurchaseController extends Controller
{
    private $purchaseService;
    private $usersAddressService;

    public function __construct(PurchaseService $purchaseService, UsersAddressService $usersAddressService)
    {
        $this->middleware('verified');
        $this->purchaseService = $purchaseService;
        $this->usersAddressService = $usersAddressService;
    }

    public function index(): \Illuminate\View\View
    {
        $data = [
            'data' => $this->usersAddressService->list(),
        ];
        return view('purchase.contact', $data);
    }

    public function back(): \Illuminate\View\View
    {
        $data = [
            'data' => $this->usersAddressService->list(),
            'Request' => session('purchase'),
        ];
        return view('purchase.contact', $data);
    }

    public function confirm(PurchaseRequest $Request): \Illuminate\View\View
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

    public function finish(): \Illuminate\View\View
    {
        $this->addSessionData();
        switch ($this->purchase()) {
            case 'quantity':
                return view('errors.quantity');
            case 'payment':
                \Log::info("err payment id:" . Auth::id());
                return view('errors.payment');
        }
        $this->sendMail();
        $this->saveSession();
        return view('purchase.finish');
    }

    private function purchase(): ?string
    {
        return DB::transaction(function () {
            //商品個数チェック
            if ($this->purchaseService->quantityCheck() == false) {
                DB::rollBack();
                return 'quantity';
            };
            //商品個数減らす
            $this->purchaseService->decrementQuantity();
            //購入履歴
            $this->purchaseService->addOrderHistory();
            //決済処理
            $payment = PaymentFactory::create();
            if ($payment->execute() == false) {
                DB::rollBack();
                return 'payment';
            };
        });
    }

    private function sendMail(): void
    {
        $bcc = 'bcc@mail.com';
        Mail::to(Auth::user()->email)
            //->cc($cc)
            //->bcc($bcc)
            ->send(new PurchaseMail());
    }

    private function addSessionData(): void
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

    private function saveSession(): void
    {
        session()->regenerateToken();
        session()->forget('cart');
        session()->forget('purchase');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Payment\PaymentFactory;
use Validator;
use DB;
use App\Services\PurchaseService;
//Mail
use Illuminate\Support\Facades\Mail;
use App\Mail\Purchase;
use App\Http\Requests\PurchaseRequest;

class PurchaseController extends Controller
{
	private $purchaseService;

	public function __construct(PurchaseService $purchaseService)
	{
		$this->purchaseService = $purchaseService;
	}

	public function index()
	{
		return view('purchase.contact');
	}

	public function back()
	{
		return view('purchase.contact', ['Request' => session('purchase')]);
	}

	public function confirm(PurchaseRequest $Request)
	{
		session(['purchase' => $Request->all()]);
		$array_view = [
			'Request' => session('purchase'),
			'cart' => session('cart'),
			'payway' => Config('const.payway')
		];
		return view('purchase.confirm', $array_view);
	}

	public function finish()
	{
		$this->purchase();
		$this->sendMail();
		$this->saveSession();
		return view('purchase.finish');
	}

	private function purchase()
	{
		DB::transaction(function () {
			//商品個数管理
			if ($this->purchaseService->decrementQuantity() == false) {
				DB::rollBack();
				return view('purchase.err_quantity');
			};
			//決済処理
			$payment = PaymentFactory::create();
			$payment->execute();
		});
	}

	private function sendMail()
	{
		//$to = 'test@gmail.com'; $cc = 'cc@mail.com'; $bcc = 'bcc@mail.com';
		//Mail::to($to)
		//->cc($cc)
		//->bcc($bcc)
		//->send(new Purchase());
	}
	private function saveSession()
	{
		session()->regenerateToken();
		session()->forget('cart');
		session()->forget('purchase');
	}
}
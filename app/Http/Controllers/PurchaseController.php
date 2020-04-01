<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Services\Payment\PaymentFactory;
use Validator;
use App\Models\Product;
use DB;
use Log;
use App\Services\PurchaseService;

//Mail
use Illuminate\Support\Facades\Mail;
use App\Mail\Purchase;

class PurchaseController extends Controller
{
	private $log_name = 'PurchaseController';
	private $log_path = '/logs/purchase.log';

	public function index()
	{
		return view('purchase.contact');
	}

	public function back()
	{
		return view('purchase.contact', ['Request' => session('purchase')]);
	}

	public function confirm(Request $Request)
	{
		$validator = $this->val($Request);
		if ($validator->fails()) {
			return view('purchase.contact', ['Request' => $Request->all(), 'errors' => $validator->errors()]);
		}
		session(['purchase' => $Request->all()]);
		$array_view = [
			'Request' => session('purchase'),
			'cart' => session('cart'),
			'payway' => Config('const.payway')
		];
		return view('purchase.confirm', $array_view);
	}

	public function finish(PurchaseService $PurchaseService)
	{
		try {
			DB::transaction(function () {
				//商品個数管理
				if ($PurchaseService->DecrementQuantity() == false) {
					DB::rollBack();
					return view('purchase.err_quantity');
				};
				//決済処理
				$payment = PaymentFactory::create();
				$payment->execute();
			});
		} catch (\PDOException $e) {
			Log::debug($e->getMessage());
			abort('500');
		} catch (\Exception $e) {
			Log::debug($e->getMessage());
			abort('500');
		}
		//メール送信
		//$to = 'test@gmail.com'; $cc = 'cc@mail.com'; $bcc = 'bcc@mail.com';
		//Mail::to($to)
		//->cc($cc)
		//->bcc($bcc)
		//->send(new Purchase());
		//セッション関連
		session()->regenerateToken();
		session()->forget('cart');
		session()->forget('purchase');
		return view('purchase.finish');
	}

	public function val($request)
	{
		$validator = Validator::make($request->all(), [
			'name'  => 'required',
			'address' => 'required',
		]);
		return $validator;
	}
}

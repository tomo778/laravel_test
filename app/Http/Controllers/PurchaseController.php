<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\DataAccess\CategoryDataAccess;
use App\Services\Payment\PaymentFactory;
use App\Library\Common;
use Validator;
use App\Models\News;
use App\Services\LoggerCustom;
use DB;

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
		if ($validator->fails() == true) {
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

	public function finish()
	{
		DB::beginTransaction();
		try {
			//throw new \PDOException('pdo');

			//商品個数管理
			if ($this->DecrementQuantity() == false) {
				//商品残りなし
				DB::rollBack();
				return view('purchase.err_quantity');
			}
			//決済処理
			$payment = PaymentFactory::create();
			if (empty($payment)) {
				throw new \Exception('nothig class');
			}
			$payment_flag = $payment->execute();
			if ($payment_flag == false) {
				//決済失敗
				DB::rollBack();
				return view('purchase.err_payment');
			}
			//throw new \PDOException;
			DB::commit();
		} catch (\PDOException $e) {
			DB::rollBack();
			$log_obj = new LoggerCustom($this->log_name);
			$log_obj->single($this->log_path, $e->getMessage());
			abort('500');
		} catch (\Exception $e) {
			DB::rollBack();
			$log_obj = new LoggerCustom($this->log_name);
			$log_obj->single($this->log_path, $e->getMessage());
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

	public function DecrementQuantity()
	{
		$cart_items = session('cart');
		foreach ($cart_items['items'] as $k => $v) {
			$tmp[] = $v['id'];
		}
		$db_items = News::lockForUpdate()
			->whereIn('id', $tmp)
			->get()
			->toArray();
		$flag = 0;
		foreach ($db_items as $k => $v) {
			$quantity = $cart_items['items'][$v['id']]['quantity'];
			if ($v['num'] < $quantity) {
				$flag = 1;
			}
		}
		if ($flag == 1) {
			return false;
		}
		//商品残りがある場合
		foreach ($cart_items['items'] as $k => $v) {
			News::where('id', $k)
				->decrement('num', $v['quantity']);
		}
		return true;
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

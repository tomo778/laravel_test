<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\DataAccess\ProductDataAccess;

class IndexController extends Controller
{
	public function index (ProductDataAccess $ProductDataAccess)
	{
		$paginate = Product::StatusCheck()->paginate(6);
		$datas = $ProductDataAccess->product_datas($paginate);
		return view('index',['paginate'=>$paginate, 'datas'=> $datas]);
	}
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $data = [
            'name' => Auth::user('admin')->name,
        ];
        return view('admin/index', $data);
    }
}

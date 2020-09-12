<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function wait(Request $request)
    {
        $wait = $request->input("sec");
        sleep((int) $wait);
        return "ok" . $wait;
    }
}

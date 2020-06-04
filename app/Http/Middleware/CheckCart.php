<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;

class CheckCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cart_items = session('cart');
        if (empty($cart_items['items'])) {
            abort('404');
        }
        return $next($request);
    }
}

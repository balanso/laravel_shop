<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;

class BasketIsNotEmpty
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
        if (Order::getTotalSum() > 0) {
            return $next($request);
        }

        session()->flash('warning', __('order.cart_is_empty'));
        return redirect()->route('index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('order_id');

        if ($orderId) {
            $order = Order::findOrFail($orderId);
            return view('basket', compact('order'));
        }

        return view('basket');

    }

    public function basketPlace()
    {
        $orderId = session('order_id');

        if (!is_null($orderId)) {
            $order = Order::find($orderId);

            if ($order) {
                return view('order', compact('order'));
            }
        }

        return redirect(route('index'));
    }

    public function basketConfirm(Request $request)
    {
        $orderId = session('order_id');

        if (!is_null($orderId)) {
            $order = Order::find($orderId);

            if ($order) {
                $success = $order->saveOrder($request->name, $request->phone, $request->email);

                if ($success) {
                    session()->flash('success', __('order.confirmed'));
                } else {
                    session()->flash('warning', __('order.confirmation_error'));
                }

                session()->forget('order_id');
                Order::resetTotalSum();
            }
        }

        return redirect(route('index'));
    }

    public function basketAdd($productId) {
        $orderId = session('order_id');

        $product = Product::findOrFail($productId);

        if (is_null($orderId)) {
            $order = Order::create();
        } else {
            $order = Order::find($orderId);

            if (!$order) {
                $order = Order::create();
            }
        }

        if (Auth::user()) {
            $order->user_id = Auth::id();
            $order->save();
        }

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($productId);
        }

        session()->flash('success', __('order.product_added', ['name'=>$product->name]));

        session(['order_id' => $order->id]);

        Order::changeTotalSum($product->price);

        return redirect(route('basket'));
    }

    public function basketRemove($productId) {
        $orderId = session('order_id');
        $order = Order::find($orderId);
        $product = Product::findOrFail($productId);

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;

            if ($pivotRow->count == 1) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }

        Order::changeTotalSum(-$product->price);

        session()->flash('warning', __('order.product_removed', ['name' => $product->name]));

        return redirect(route('basket'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public static function getTotalSum()
    {
        return session()->get('order_total_sum');
    }

    public static function changeTotalSum($change) {
        $total = session()->get('order_total_sum') + $change;
        return session(['order_total_sum'=> $total]);
    }

    public static function resetTotalSum()
    {
        return session(['order_total_sum' => 0]);
    }

    public function calculate()
    {
        return $this->products->reduce(function ($accum, $item) {
            return $accum + $item->getPriceForCount();
        }, 0);
    }

    public function scopeActive($query) {
        return $query->where('status', 1);
    }

    public function saveOrder($name, $phone = null, $email = null)
    {
        if ($this->status == 0) {
            $this->name = $name;
            $this->email = $email;
            $this->phone = $phone;
            $this->status = 1;
            $this->save();

            return true;
        }

        return false;
    }
}

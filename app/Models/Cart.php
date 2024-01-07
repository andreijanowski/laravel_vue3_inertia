<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Cart extends Pivot
{
    protected $table = 'carts';

    /**
     * @param ?string $instance
     */
    public static function getContent()
    {
        return auth()->user()->cart()->get();
    }

    /**
     * @param int $id
     */
    public static function getCartTotal($products)
    {
        $total = "0.00";

        foreach ($products as $item) {
            $total += $item->price * $item->pivot->quantity;
        }

        return number_format($total, 2);
    }

    public static function empty()
    {
        $ids = Cart::getContent();

        auth()->user()->cart()
            ->detach($ids->pluck('id'));
    }
}

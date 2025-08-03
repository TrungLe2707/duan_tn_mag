<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'voucher_id', 'subtotal', 'shipping_fee', 'voucher_discount', 'total', 'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderDetail::class);
    }
}

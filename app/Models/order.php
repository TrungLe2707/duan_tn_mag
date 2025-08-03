<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', 'voucher_id', 'total_price', 'status'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
<<<<<<< HEAD
     public function address()
    {
        return $this->belongsTo(addresses::class);
    }
=======
    public function address()
{
    return $this->belongsTo(addresses::class, 'address_id');
}
>>>>>>> 502fab33ec1a3ef13986297172dcfab8924c3e03
}
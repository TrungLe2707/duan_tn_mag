<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_variant_id',
        'quantity',
    ];
    public function productVariant()
    {
        return $this->belongsTo(product_variants::class, 'product_variant_id');
    }
}

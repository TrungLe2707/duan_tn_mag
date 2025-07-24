<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_images extends Model
{
    protected $table = 'product_images';

    protected $fillable = ['product_id', 'path', 'order'];

    public $incrementing = true;
    public $timestamps = false;

    public function image_product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}

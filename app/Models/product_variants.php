<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class product_variants extends Model
{
    protected $fillable = ['product_id', 'name', 'sku', 'size_id', 'color_id', 'price', 'quantity'];
    public $timestamps = false; // Thêm nếu bảng không có timestamps

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }


    public function size()
    {
        return $this->belongsTo(Sizes::class);
    }



    public function image(){


    return $this->hasOne(Product_images::class, 'id', 'product_img_id'); // hoặc tuỳ theo quan hệ bạn thiết kế
}
      public function color()

    {
        return $this->belongsTo(Colors::class, 'color_id');
    }



}


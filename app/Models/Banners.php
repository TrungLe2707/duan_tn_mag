<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'cta_text',
        'status',
        'sort_order',
    ];
}

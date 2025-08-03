<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;
<<<<<<< HEAD
    

=======
>>>>>>> 502fab33ec1a3ef13986297172dcfab8924c3e03
    protected $fillable = ['title', 'category_id', 'description', 'content', 'image', 'author', 'posted_date', 'status'];
    // public $timestamps = false;
    public function new_category()
    {

        return $this->belongsTo(NewCategory::class, 'category_id');
    }
    protected $casts = [
        'posted_date' => 'datetime' // Tự động convert sang Carbon
    ];
}

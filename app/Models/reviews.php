<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reviews extends Model
{
    public $timestamps = true;
<<<<<<< HEAD
     protected $fillable = [
=======
    
    protected $fillable = [
>>>>>>> 502fab33ec1a3ef13986297172dcfab8924c3e03
        'user_id',
        'product_id',
        'parent_id',
        'comment',
<<<<<<< HEAD
        'rating', // nếu có
    ];
=======
        'rating',
        'status' // added status field for moderation
    ];

>>>>>>> 502fab33ec1a3ef13986297172dcfab8924c3e03
    public function user()
    {
        return $this->belongsTo(User::class);
    }
<<<<<<< HEAD
=======

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

>>>>>>> 502fab33ec1a3ef13986297172dcfab8924c3e03
    public function replies()
    {
        return $this->hasMany(reviews::class, 'parent_id')->with('user');
    }

    public function parent()
    {
        return $this->belongsTo(reviews::class, 'parent_id');
    }
<<<<<<< HEAD
        public function children()
    {
        return $this->hasMany(reviews::class, 'parent_id');
    }
}
=======

    public function children()
    {
        return $this->hasMany(reviews::class, 'parent_id');
    }
}
>>>>>>> 502fab33ec1a3ef13986297172dcfab8924c3e03

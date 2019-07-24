<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'price',
        'type',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image_url',
        'user_id'
    ];

    public function user()
    {
       return $this->belongsTo(User::class);
    }
}

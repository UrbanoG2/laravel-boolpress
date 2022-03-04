<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        "string",
        "slug",
    ];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function posts()
    {
        return $this->belongsToMany('App\Model\Post')
        ->withTimestamps();
    }
}


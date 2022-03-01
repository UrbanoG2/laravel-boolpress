<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        "title",
        "author",
        "text",
        "slug",
        "user_id",
        "created_at",
        "updated_at"
    ];

    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}

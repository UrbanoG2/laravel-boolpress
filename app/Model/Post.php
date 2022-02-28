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
        "created_at",
        "updated_at"
    ];
}

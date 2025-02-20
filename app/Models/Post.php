<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'excerpt', 'content', 'image', 'category_id', 'author', 'views', 'category'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

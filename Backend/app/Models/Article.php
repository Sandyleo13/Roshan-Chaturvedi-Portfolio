<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category',
        'difficulty',
        'slug',
        'tags',
        'image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_latest'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
    'title',
    'content',
    'excerpt',
    'category',
    'read_time',
    'publish_date',
    'image',
    'featured',
    'slug',
    'meta_title',
    'meta_description',
    'meta_keywords',
    'is_latest',
];


    protected $casts = [
        'publish_date' => 'date',
    ];

    // Automatically create slug on creation
    public static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);

                // Ensure slug uniqueness
                $originalSlug = $blog->slug;
                $counter = 1;
                while (Blog::where('slug', $blog->slug)->exists()) {
                    $blog->slug = $originalSlug . '-' . $counter++;
                }
            }
        });
    }
}

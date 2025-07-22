<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'slug',
        'metrics',
        'technologies',
        'features',
        'links',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'metrics' => 'array',
        'technologies' => 'array',
        'features' => 'array',
        'links' => 'array',
    ];

    // Automatically generate slug if not provided
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($work) {
            if (empty($work->slug)) {
                $work->slug = Str::slug($work->title) . '-' . uniqid();
            }
        });
    }
}

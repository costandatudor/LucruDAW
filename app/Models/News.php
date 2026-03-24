<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'image',
        'author',
        'published',
        'published_at',
    ];

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Scope for published news
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    // Scope for latest news
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }
}

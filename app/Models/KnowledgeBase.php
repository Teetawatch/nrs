<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class KnowledgeBase extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'content', 'excerpt', 'cover_image',
        'external_url', 'type', 'category_id', 'view_count', 'status',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(KnowledgeCategory::class, 'category_id');
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        if (!$this->cover_image) return null;
        return asset('storage/' . $this->cover_image);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}

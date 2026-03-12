<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class DocumentCategory extends Model
{
    use HasSlug;

    protected $fillable = ['name', 'slug', 'icon', 'color', 'order'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'category_id');
    }
}

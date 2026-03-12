<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class KnowledgeCategory extends Model
{
    use HasSlug;

    protected $fillable = ['name', 'slug', 'icon', 'order'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function knowledgeBases(): HasMany
    {
        return $this->hasMany(KnowledgeBase::class, 'category_id');
    }
}

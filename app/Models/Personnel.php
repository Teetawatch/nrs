<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Personnel extends Model
{
    use HasSlug;

    protected $table = 'personnel';
    protected $fillable = [
        'prefix', 'first_name', 'last_name', 'slug', 'position', 'rank',
        'photo', 'bio', 'email', 'phone', 'role_type', 'department_id', 'order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['first_name', 'last_name'])
            ->saveSlugsTo('slug');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->prefix . ' ' . $this->first_name . ' ' . $this->last_name);
    }

    public function getPhotoUrlAttribute(): string
    {
        if (!$this->photo) return asset('images/no-photo.png');
        return asset($this->photo);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolHistory extends Model
{
    protected $fillable = ['title', 'content', 'cover_image', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function getCoverImageUrlAttribute(): ?string
    {
        if (!$this->cover_image) return null;
        return asset('storage/' . $this->cover_image);
    }
}

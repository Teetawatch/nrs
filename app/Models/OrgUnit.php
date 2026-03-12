<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrgUnit extends Model
{
    protected $fillable = ['name', 'short_name', 'description', 'image', 'parent_id', 'order'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(OrgUnit::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(OrgUnit::class, 'parent_id')->orderBy('order');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;
        return asset('storage/' . $this->image);
    }
}

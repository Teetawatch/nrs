<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolSystem extends Model
{
    protected $fillable = [
        'name', 'description', 'url', 'icon', 'logo', 'color',
        'category_id', 'open_new_tab', 'is_active', 'order',
    ];

    protected $casts = [
        'open_new_tab' => 'boolean',
        'is_active'    => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(SystemCategory::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

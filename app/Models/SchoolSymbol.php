<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolSymbol extends Model
{
    protected $fillable = ['name', 'description', 'content', 'image', 'order'];

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;
        return asset('storage/' . $this->image);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = 'curriculums';
    protected $fillable = ['name', 'level', 'description', 'image', 'is_active', 'order'];

    protected $casts = ['is_active' => 'boolean'];

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;
        return asset('storage/' . $this->image);
    }
}

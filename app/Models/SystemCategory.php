<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SystemCategory extends Model
{
    protected $fillable = ['name', 'order'];

    public function systems(): HasMany
    {
        return $this->hasMany(SchoolSystem::class, 'category_id');
    }
}

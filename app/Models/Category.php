<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
      'title', 'parent_id'
    ];

    public function advertisements():HasMany
    {
        return $this->hasMany(Advertisement::class);
    }

    public function children():HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function scopeOnlyParents(Builder $query): Builder
    {
        return $query->whereNull('parent_id')->with('children');
    }
}

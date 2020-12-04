<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Advertisement extends Model implements HasMedia
{
    use InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'phone',
        'country',
        'end_date',
        'user_id',
        'latitude',
        'longitude',
        'email',
        'category_id',
    ];

    protected $dates = ['end_date', 'created_at'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments():BelongsToMany
    {
        return $this->belongsToMany(Comment::class);
    }

    public function favorites():BelongsToMany
    {
        $this->belongsToMany(Favorite::class);
    }

    public function getImageAttribute()
    {
        $media = '/images/noimage.png';

        if ($this->hasMedia('advertisement')) {
            $media = $this->getFirstMediaUrl('advertisement');
        }

        return $media;
    }

}

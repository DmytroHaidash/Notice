<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Advertisement extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'phone',
        'country',
        'end_date',
        'user_id',
        'latitude',
        'longitude',
        'email'
    ];

    protected $dates = ['end_date', 'created_at'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments():BelongsToMany
    {
        return $this->belongsToMany(Comment::class);
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

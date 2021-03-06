<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'about',
        'latitude',
        'longitude',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function advertisements():HasMany
    {
        return $this->hasMany(Advertisement::class);
    }

    public function favorites():HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function subscribes():HasOne
    {
        return $this->hasOne(Subscribe::class);
    }

    public function getImageAttribute()
    {
        $media = '/images/noimage.png';

        if ($this->hasMedia('avatar')) {
            $media = $this->getFirstMediaUrl('avatar');
        }

        return $media;
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getMapAttribute()
    {
        $map['latlng']['lat'] = $this->latitude;
        $map['latlng']['lng'] = $this->longitude;
        return json_encode($map);
    }

    public function setMapAttribute($value)
    {
        $value = json_decode($value);
        $this->attributes['latitude'] = $value->latlng->lat;
        $this->attributes['longitude'] = $value->latlng->lng;
    }
}

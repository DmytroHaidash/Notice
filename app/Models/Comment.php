<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'advertisement_id', 'content'
    ];

    public function user():HasOne
    {
        return $this->hasOne(User::class);
    }

    public function advertisement():HasOne
    {
        return $this->hasOne(Advertisement::class);
    }
}

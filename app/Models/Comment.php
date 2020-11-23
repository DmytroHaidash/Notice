<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'advertisement_id', 'content'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function advertisement():BelongsTo
    {
        return $this->belongsTo(Advertisement::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PollOption extends Model
{
    protected $fillable = [
        'poll_id',
        'actress_id',
        'image',
    ];

    public function poll(): BelongsTo
    {
        return $this->belongsTo(Poll::class);
    }

    public function actress(): BelongsTo
    {
        return $this->belongsTo(Actress::class);
    }
}

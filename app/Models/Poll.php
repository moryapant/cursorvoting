<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poll extends Model
{
    use HasFactory;

    // Remove the SoftDeletes trait if it's there
    // use SoftDeletes;

    protected $fillable = [
        'title',
        'category',
        'start_date',
        'end_date',
        'image',
        'archived',
    ];

    protected $casts = [
        'end_date' => 'datetime:Y-m-d H:i:s',
        'archived' => 'boolean', // Add this line
    ];

    public function options(): HasMany
    {
        return $this->hasMany(PollOption::class);
    }

    // Define the votes relationship
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Scope a query to only include active (non-archived) polls.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('archived', false);
    }

    /**
     * Scope a query to only include archived polls.
     */
    public function scopeArchived(Builder $query): Builder
    {
        return $query->where('archived', true);
    }

    // If you want to customize the Carbon instance, you can use a custom cast:
    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value instanceof Carbon ? $value : Carbon::parse($value);
    }
}

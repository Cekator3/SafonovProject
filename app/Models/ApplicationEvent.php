<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicationEvent extends Model
{
    use HasFactory;

    /**
     * Because table don't have a created_at and updated_at columns
     */
    public $timestamps = false;

    /**
     * Get the user that fired this event
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

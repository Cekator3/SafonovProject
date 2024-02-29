<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;

    /**
     * Because table don't have a created_at and updated_at columns
     */
    public $timestamps = false;

    /**
     * Get logs that was fired by this user
     */
    public function application_events(): HasMany
    {
        return $this->hasMany(ApplicationEvent::class);
    }
}

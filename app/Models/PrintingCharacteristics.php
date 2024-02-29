<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrintingCharacteristics extends Model
{
    use HasFactory;

    /**
     * Because table don't have a created_at and updated_at columns
     */
    public $timestamps = false;

    /**
     * Get the printing technology to which this printing characteristic belongs
     */
    public function printing_technologies(): BelongsTo
    {
        return $this->belongsTo(PrintingTechnologies::class);
    }
}

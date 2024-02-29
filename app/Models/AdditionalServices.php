<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AdditionalServices extends Model
{
    use HasFactory;

    /**
     * Because table don't have a created_at and updated_at columns
     */
    public $timestamps = false;

    /**
     * Get printing technologies where this additional service is available
     */
    public function printing_technologies(): BelongsToMany
    {
        return $this->belongsToMany(
            PrintingTechnologies::class, 
            'printing_technologies_of_postprocessing_additional_service', 
            'additional_service_id', 
            'printing_technology_id'
        );
    }
}

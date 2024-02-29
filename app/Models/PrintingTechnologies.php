<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrintingTechnologies extends Model
{
    use HasFactory;

    /**
     * Because table don't have a created_at and updated_at columns
     */
    public $timestamps = false;

    /**
     * Get printing characteristics associated with this printing technology
     */
    public function printing_characteristics(): HasMany
    {
        return $this->hasMany(PrintingCharacteristics::class);
    }

    /**
     * Get additional services that are available for this printing technology
     */
    public function additional_services(): BelongsToMany
    {
        return $this->belongsToMany(
            AdditionalServices::class, 
            'printing_technologies_of_postprocessing_additional_service', 
            'printing_technology_id', 
            'additional_service_id'
        );
    }
}

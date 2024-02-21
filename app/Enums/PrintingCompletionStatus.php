<?php

namespace App\Enums;

enum PrintingCompletionStatus : string
{
    case PrintingInProgress = 'printing_in_progress';
    case PrintingFinished = 'printing_finished';
    case PrintingPostProcessingAwaiting = 'printing_post_processing_awaiting';

    /**
     * Returns values associated with PrintingCompletionStatus enum.
     * @return array<string>
     */
    public static function GetAllValues() : array
    {
        return [
            static::PrintingInProgress->value,
            static::PrintingFinished->value,
            static::PrintingPostProcessingAwaiting->value,
        ];
    }
}

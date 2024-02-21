<?php
namespace App\Enums;

enum OrderedModelCompletionStatus : string
{
    case NeedsAdminChecking = 'needs_admin_checking';
    case OnAdminChecking = 'on_admin_checking';
    case NeedsToBePrinted = 'needs_to_be_printed';
    case IsInPrinterQueue = 'is_in_printer_queue';
    case IsBeingPrinted = 'is_being_printed';
    case IsOnPostProcessing = 'is_on_post_processing';
    case IsOnAdminFinalCheck = 'is_on_admin_final_check';
    case Completed = 'completed';

    /**
     * Returns values associated with OrderedModelCompletionStatus enum.
     * @return array<string>
     */
    public static function GetAllValues() : array
    {
        return [
            static::NeedsAdminChecking->value,
            static::OnAdminChecking->value,
            static::NeedsToBePrinted->value,
            static::IsInPrinterQueue->value,
            static::IsBeingPrinted->value,
            static::IsOnPostProcessing->value,
            static::IsOnAdminFinalCheck->value,
            static::Completed->value,
        ];
    }
}

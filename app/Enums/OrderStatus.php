<?php
namespace App\Enums;

enum OrderStatus : string
{
    case NeedsChecking = 'needs_checking';
    case OnChecking = 'on_checking';
    case WaitingForPayment = 'waiting_for_payment';
    case OnExecution = 'on_execution';
    case OnDelivery = 'on_delivery';

    /**
     * Returns values associated with OrderStatus enum.
     * @return array<string>
     */
    public static function GetAllValues() : array
    {
        return [
            static::NeedsChecking->value,
            static::OnChecking->value,
            static::WaitingForPayment->value,
            static::OnExecution->value,
            static::OnDelivery->value,
        ];
    }
}

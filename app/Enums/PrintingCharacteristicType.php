<?php
namespace App\Enums;

enum PrintingCharacteristicType : string
{
    case boolean = 'boolean';
    case number = 'number';

    /**
     * Returns values associated with PrintingCharacteristicType enum.
     * 
     * @return array<string>
     */
    public static function GetAllValues() : array
    {
        return [
            static::boolean->value,
            static::number->value,
        ];
    }
}

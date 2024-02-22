<?php
namespace App\Enums;

enum AdditionalServiceType : string
{
    case preprocessing = 'preprocessing';
    case postprocessing = 'postprocessing';

    /**
     * Returns values associated with AdditionalServiceType enum.
     * 
     * @return array<string>
    */
    public static function GetAllValues() : array
    {
        return [
            static::preprocessing->value,
            static::postprocessing->value,
        ];
    }
}

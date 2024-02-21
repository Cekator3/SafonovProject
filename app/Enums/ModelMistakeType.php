<?php
namespace App\Enums;

enum ModelMistakeType : string
{
    case BaseModelMistake = 'base_model_mistake';
    case NormalUnpreparedModelMistake = 'normal_unprepared_model_mistake';
    case CompositeUnpreparedModelMistake = 'composite_unprepared_model_mistake';
    case PreparedModelMistake = 'prepared_model_mistake';
    case UnknownMistake = 'unknown_mistake';

    /**
     * Returns values associated with ModelMistakeType enum.
     * @return array<string>
     */
    public static function GetAllValues() : array
    {
        return [
            static::BaseModelMistake->value,
            static::NormalUnpreparedModelMistake->value,
            static::CompositeUnpreparedModelMistake->value,
            static::PreparedModelMistake->value,
            static::UnknownMistake->value,
        ];
    }
}

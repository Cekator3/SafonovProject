<?php
namespace App\Enums;

enum OrderDeliveryMethod : string
{
    case SelfDelivery = 'self_delivery';
    case CourierDelivery = 'courier_delivery';
    case Sdek ='sdek';
    case RussianPost = 'russian_post';

    /**
     * Returns values associated with OrderDeliveryMethod enum.
     * @return array<string>
     */
    public static function GetAllValues() : array
    {
        return [
            static::SelfDelivery->value,
            static::CourierDelivery->value,
            static::Sdek->value,
            static::RussianPost->value,
        ];
    }
}

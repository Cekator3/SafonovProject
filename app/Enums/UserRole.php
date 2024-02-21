<?php
namespace App\Enums;

enum UserRole : string
{
    case Customer = 'customer';
    case PrintMaster = 'print_master';
    case Admin = 'admin';
    case Superuser ='superuser';

    /**
     * Returns values associated with UserRole enum.
     * @return array<string>
     */
    public static function GetAllValues() : array
    {
        return [
            static::Customer->value,
            static::PrintMaster->value,
            static::Admin->value,
            static::Superuser->value,
        ];
    }
}

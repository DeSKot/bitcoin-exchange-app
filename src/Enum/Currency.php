<?php

namespace App\Enum;

class Currency
{
    public const USD = 'USD';
    public const EUR = 'EUR';
    public const GBP = 'GBP';

    public static function getAll(): array
    {
        return [
            self::EUR,
            self::USD,
            self::GBP
        ];
    }
}
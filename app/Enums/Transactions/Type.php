<?php

namespace App\Enums\Transactions;

enum Type: string
{
    case DEPOSIT = 'deposit';
    case WITHDRAWAL = 'withdrawal';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}

<?php

namespace App\Repository\Interface;

use App\Entity\Currency;

interface CurrencyRepositoryInterface
{
    public function getCurrencyEntityByName(string $currency): Currency;
}
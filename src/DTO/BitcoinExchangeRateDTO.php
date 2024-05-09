<?php

namespace App\DTO;

use App\Entity\Currency;
use DateTimeImmutable;

class BitcoinExchangeRateDTO
{
    private Currency $currencyID;
    private string $exchangeRate;
    private DateTimeImmutable $dateTimeImmutable;

    public function setCurrencyId(Currency $currency): void
    {
        $this->currencyID = $currency;
    }

    public function getCurrencyID(): Currency
    {
        return $this->currencyID;
    }

    public function setExchangeRate(string $exchangeRate): void
    {
        $this->exchangeRate = $exchangeRate;
    }

    public function getExchangeRate(): string
    {
        return $this->exchangeRate;
    }

    public function setDateTimeImmutable(DateTimeImmutable $dateTimeImmutable): void
    {
        $this->dateTimeImmutable = $dateTimeImmutable;
    }

    public function getDateTimeImmutable(): DateTimeImmutable
    {
        return $this->dateTimeImmutable;
    }
}
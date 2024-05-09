<?php

namespace App\Service\BitcoinExchange;

use App\DTO\BitcoinRequestDTO;

interface BitcoinExchangeServiceInterface
{
    public function importData(string $currency);

    public function displayCurrencyData(BitcoinRequestDTO $bitcoinRequestDTO): array;
}
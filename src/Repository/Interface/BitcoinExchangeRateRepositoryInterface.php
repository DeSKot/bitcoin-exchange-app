<?php

namespace App\Repository\Interface;

use App\DTO\BitcoinExchangeRateDTO;
use App\DTO\BitcoinRequestDTO;

interface BitcoinExchangeRateRepositoryInterface
{
    public function getExchangeRateData(BitcoinRequestDTO $bitcoinRequestDTO): array;

    public function save(BitcoinExchangeRateDTO $dto): void;
}
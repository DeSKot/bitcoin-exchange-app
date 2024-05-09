<?php

namespace App\Service\BitcoinExchange;

use App\DTO\BitcoinExchangeRateDTO;
use App\DTO\BitcoinRequestDTO;
use App\Repository\Interface\BitcoinExchangeRateRepositoryInterface;
use App\Repository\Interface\CurrencyRepositoryInterface;
use GuzzleHttp\Client;
use Throwable;

class BitcoinExchangeService implements BitcoinExchangeServiceInterface
{
    public function __construct(
        private BitcoinExchangeRateRepositoryInterface $exchangeRateRepository,
        private CurrencyRepositoryInterface $currencyRepository,
        private string $exchangeBitcoinMarketUrl,
    )
    {
    }

    public function importData(string $currency): void
    {
        try {
            $client = new Client();
            $response = json_decode($client->get($this->exchangeBitcoinMarketUrl . $currency)->getBody()->getContents());

            $dto = new BitcoinExchangeRateDTO();
            $dto->setExchangeRate($response->last_trade_price);
            $dto->setDateTimeImmutable(new \DateTimeImmutable());
            $dto->setCurrencyId($this->currencyRepository->getCurrencyEntityByName($currency));

            $this->exchangeRateRepository->save($dto);
        } catch (Throwable $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode());
        }
    }

    public function displayCurrencyData(BitcoinRequestDTO $bitcoinRequestDTO): array
    {
        return $this->exchangeRateRepository->getExchangeRateData($bitcoinRequestDTO);
    }
}
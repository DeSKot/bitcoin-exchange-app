<?php

namespace App\DTO;

use Symfony\Component\HttpFoundation\Request;

class BitcoinRequestDTO
{

    private string $currency;
    private string|null $fromDate = null;
    private string|null $toDate = null;
    private int $countOfRows = 24;

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function getCurrency(): string
    {
        return  $this->currency;
    }

    public function setFromDate(string|null $fromDate): void
    {
        $this->fromDate = $fromDate;
    }

    public function getFromDate(): string|null
    {
        return $this->fromDate;
    }

    public function setToDate(string|null $toDate): void
    {
        $this->toDate = $toDate;
    }

    public function getToDate(): string|null
    {
        return $this->toDate;
    }

    public function setCountOfRows(int $countOfRows): void
    {
        $this->countOfRows = $countOfRows;
    }

    public function getCountOfRows(): int
    {
        return $this->countOfRows;
    }

    public static function getDtoByRequest(Request $request): self
    {
        $obj = new self();
        $obj->setCurrency($request->get('currency'));
        $obj->setFromDate($request->get('fromDate'));
        $obj->setToDate($request->get('toDate'));
        $obj->setCountOfRows($request->get('rows'));

        return $obj;
    }
}
<?php

namespace App\Entity;

use App\DTO\BitcoinExchangeRateDTO;
use App\Repository\Entity\BitcoinExchangeRateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BitcoinExchangeRateRepository::class)]
class BitcoinExchangeRate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Currency $currency_id = null;

    #[ORM\Column(length: 255)]
    private ?string $exchange_rate = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCurrencyId(): ?Currency
    {
        return $this->currency_id;
    }

    public function setCurrencyId(?Currency $currency_id): static
    {
        $this->currency_id = $currency_id;

        return $this;
    }

    public function getExchangeRate(): ?string
    {
        return $this->exchange_rate;
    }

    public function setExchangeRate(string $exchange_rate): static
    {
        $this->exchange_rate = $exchange_rate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}

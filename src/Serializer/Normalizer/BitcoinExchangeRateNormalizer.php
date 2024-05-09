<?php

namespace App\Serializer\Normalizer;

use DateTimeInterface;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class BitcoinExchangeRateNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{

    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'id'           => $object->getId(),
            'exchangeRate' => $object->getExchangeRate(),
            'time'         => $object->getCreatedAt()->format(DateTimeInterface::RSS)
        ];
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof \App\Entity\BitcoinExchangeRate;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}

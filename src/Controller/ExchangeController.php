<?php

namespace App\Controller;

use App\DTO\BitcoinRequestDTO;
use App\Service\BitcoinExchange\BitcoinExchangeServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ExchangeController extends AbstractController
{

    public function __construct(
        private BitcoinExchangeServiceInterface $bitcoinExchangeService,
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->json(
            $this->bitcoinExchangeService->displayCurrencyData(BitcoinRequestDTO::getDtoByRequest($request))
        );
    }
}

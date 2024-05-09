<?php

namespace App\Command;

use App\Enum\Currency;
use App\Service\BitcoinExchange\BitcoinExchangeServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name       : 'import:bitcoin-exchange-rate',
    description: 'Import Bitcoin exchange rate by given currency',
)]
class ImportBitcoinExchangeRateCommand extends Command
{

    public function __construct(
        private BitcoinExchangeServiceInterface $bitcoinExchangeService,
        private LoggerInterface $logger,
        private EntityManagerInterface $entityManager
    )
    {
        parent::__construct(null);
    }

    public const CURRENCY_ARGUMENT_NAME = 'currency';

    protected function configure(): void
    {
        $this
            ->addArgument(self::CURRENCY_ARGUMENT_NAME, InputArgument::IS_ARRAY, 'Get exchange currency', []);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->logger->info('Import bitcoin exchange rate data status: in progress');

        $io = new SymfonyStyle($input, $output);

        $this->entityManager->getConnection()->beginTransaction();

        try {
            foreach ($input->getArgument(self::CURRENCY_ARGUMENT_NAME) as $currency) {
                if (!in_array($currency, Currency::getAll())) {
                    $io->error('Dont support currency ' . $currency . '. Please select one of this ' . implode(',', Currency::getAll()));
                    $this->entityManager->getConnection()->rollBack();
                    return Command::INVALID;
                }

                $this->bitcoinExchangeService->importData($currency);
            }
        } catch (\Throwable $exception) {
            $this->entityManager->getConnection()->rollBack();
            $this->logger->error($exception->getMessage());
        }

        $this->entityManager->getConnection()->commit();

        $io->success('success');

        $this->logger->info('Import bitcoin exchange rate data status: DONE');
        return Command::SUCCESS;
    }
}

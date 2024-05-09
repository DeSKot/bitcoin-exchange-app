<?php

namespace App\Repository\Entity;

use App\DTO\BitcoinExchangeRateDTO;
use App\DTO\BitcoinRequestDTO;
use App\Entity\BitcoinExchangeRate;
use App\Entity\Currency;
use App\Repository\Interface\BitcoinExchangeRateRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BitcoinExchangeRate>
 *
 * @method BitcoinExchangeRate|null find($id, $lockMode = null, $lockVersion = null)
 * @method BitcoinExchangeRate|null findOneBy(array $criteria, array $orderBy = null)
 * @method BitcoinExchangeRate[]    findAll()
 * @method BitcoinExchangeRate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BitcoinExchangeRateRepository extends ServiceEntityRepository implements BitcoinExchangeRateRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BitcoinExchangeRate::class);
    }

    public function getExchangeRateData(BitcoinRequestDTO $bitcoinRequestDTO): array
    {
        return $this->createQueryBuilder('b')
            ->setParameter(
                'currencyId',
                $this->getEntityManager()->getRepository(Currency::class)->getCurrencyEntityByName(
                    $bitcoinRequestDTO->getCurrency()
                )
            )
            ->setParameter('fromDate', $bitcoinRequestDTO->getFromDate())
            ->setParameter('toDate', $bitcoinRequestDTO->getToDate())
            ->where('b.currency_id = :currencyId')
            ->andWhere('b.createdAt >= :fromDate')
            ->andWhere('b.createdAt >= :toDate')
            ->setMaxResults($bitcoinRequestDTO->getCountOfRows())
            ->getQuery()
            ->getResult();
    }

    public function save(BitcoinExchangeRateDTO $dto): void
    {
        $entityManager = $this->getEntityManager();

        $entity = new BitcoinExchangeRate();
        $entity->setExchangeRate($dto->getExchangeRate());
        $entity->setCurrencyId($dto->getCurrencyID());
        $entity->setCreatedAt($dto->getDateTimeImmutable());

        $entityManager->persist($entity);
        $entityManager->flush();
    }
}

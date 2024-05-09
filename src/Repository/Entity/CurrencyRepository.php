<?php

namespace App\Repository\Entity;

use App\Entity\Currency;
use App\Repository\Interface\CurrencyRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @extends ServiceEntityRepository<Currency>
 *
 * @method Currency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Currency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Currency[]    findAll()
 * @method Currency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyRepository extends ServiceEntityRepository implements CurrencyRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Currency::class);
    }

    public function getCurrencyEntityByName(string $currency): Currency
    {
        $currencyEntity = $this->findOneBy(
            ['name' => $currency]
        );

        if (!$currencyEntity) {
            throw new Exception($currency . ' - does not find currency name in DB');
        }

        return $currencyEntity;
    }
}

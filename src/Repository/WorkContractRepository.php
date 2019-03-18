<?php

namespace App\Repository;

use App\Entity\WorkContract;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WorkContract|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkContract|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkContract[]    findAll()
 * @method WorkContract[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkContractRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WorkContract::class);
    }

    public function save($workContract)
    {
        $this->getEntityManager()->persist($workContract);
        $this->getEntityManager()->flush();
    }
}

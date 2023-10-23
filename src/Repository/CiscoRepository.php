<?php

namespace App\Repository;

use App\Entity\Cisco;
use App\Entity\Dren;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cisco>
 *
 * @method Cisco|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cisco|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cisco[]    findAll()
 * @method Cisco[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CiscoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cisco::class);
    }

    public function add(Cisco $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cisco $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /* public function findByCountryOrderedByAscName(Cisco $cisco): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c. = :ciscos')
            ->setParameter('ciscos', $cisco)
            ->orderBy('c.nom_dren', 'ASC')
            ->getQuery()
            ->getResult();
    }*/
    public function findByDrenOrderedByAscName( $dren): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.drencisco = :drencisco')
            ->setParameter('drencisco', $dren)
            ->orderBy('c.nom_cisco', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Cisco[] Returns an array of Cisco objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Cisco
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

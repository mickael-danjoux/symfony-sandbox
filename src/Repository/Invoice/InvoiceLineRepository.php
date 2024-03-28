<?php

namespace App\Repository\Invoice;

use App\Entity\Invoice\InvoiceLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InvoiceLine>
 *
 * @method InvoiceLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method InvoiceLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method InvoiceLine[]    findAll()
 * @method InvoiceLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InvoiceLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InvoiceLine::class);
    }

//    /**
//     * @return InvoiceLine[] Returns an array of InvoiceLine objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InvoiceLine
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

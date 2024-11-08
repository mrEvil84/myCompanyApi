<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Company;
use App\ReadModel\CompanyReadModelRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Company>
 */
class CompanyReadModelDbRepository extends ServiceEntityRepository implements CompanyReadModelRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    public function getCompanies(int $limit = 10, int $offset = 0): array
    {
        return $this->createQueryBuilder('company')
            ->select('company.id', 'company.name', 'company.taxIdNumber')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }

    public function getCompanyById(int $companyId): array
    {
        return $this->createQueryBuilder('company')
            ->where('company.id = :company_id')
            ->setParameter('company_id', $companyId)
            ->getQuery()
            ->setMaxResults(1)
            ->getArrayResult();
    }
}

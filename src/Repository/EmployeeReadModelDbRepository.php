<?php

namespace App\Repository;

use App\Entity\Company;
use App\ReadModel\CompanyReadModelRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Company>
 */
class EmployeeReadModelDbRepository extends ServiceEntityRepository implements CompanyReadModelRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    public function getCompanies(int $limit = 10, int $offset = 0): array
    {
        return $this->createQueryBuilder('company')
            ->select('company.name', 'company.taxIdNumber')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }

    public function getCompanyByTaxIdNumber(string $taxIdNumber): array
    {
        return $this->createQueryBuilder('company')
            ->where('company.taxIdNumber = :taxIdNumber')
            ->setParameter('taxIdNumber', $taxIdNumber)
            ->getQuery()
            ->setMaxResults(1)
            ->getArrayResult();
    }

    public function getCompanyEmployees(string $taxIdNumber, int $limit = 10, int $offset = 0): array
    {
        return $this->createQueryBuilder('company')
            ->join('company.employees', 'employee')
            ->where('company.taxIdNumber = :taxIdNumber')
            ->setParameter('taxIdNumber', $taxIdNumber)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }
}

<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Company;
use App\Entity\Employee;
use App\ReadModel\EmployeeReadModelRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Company>
 */
class EmployeeReadModelDbRepository extends ServiceEntityRepository implements EmployeeReadModelRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
    }

    public function getCompanyEmployees(int $companyId, int $limit = 10, int $offset = 0): array
    {
        return $this->createQueryBuilder('company')
            ->join('company.company', 'c', 'WITH', 'c.id = :companyId')
            ->setParameter('companyId', $companyId)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }

    public function getEmployee(int $employeeId): array
    {
        return $this->createQueryBuilder('employee')
            ->where('employee.id = :employeeId')
            ->setParameter('employeeId', $employeeId)
            ->getQuery()
            ->getArrayResult();
    }
}

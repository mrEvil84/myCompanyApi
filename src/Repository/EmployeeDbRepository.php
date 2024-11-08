<?php

declare(strict_types=1);

namespace App\Repository;

use App\Application\Shared\EmployeeDto;
use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\DomainModel\EmployeeRepository;

/**
 * @extends ServiceEntityRepository<Employee>
 */
class EmployeeDbRepository extends ServiceEntityRepository implements EmployeeRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employee::class);
    }

    public function getEmployeeByData(EmployeeDto $employeeDto): ?Employee
    {
        return $this->createQueryBuilder('e')
            ->join('e.company', 'c', 'WITH', 'c.taxIdNumber = :taxIdNumber')
            ->andWhere('e.name = :name')
            ->andWhere('e.surname = :surname')
            ->andWhere('e.email = :email')
            ->setParameter('taxIdNumber', $employeeDto->getCompanyId())
            ->setParameter('name', $employeeDto->getName())
            ->setParameter('surname', $employeeDto->getSurname())
            ->setParameter('email', $employeeDto->getEmail())
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function employeeExistsInCompany(EmployeeDto $employeeDto): bool
    {
        $result = $this->createQueryBuilder('e')
            ->select('count(e.id)')
            ->join('e.company', 'c', 'WITH', 'c.id = :companyId')
            ->andWhere('e.name = :name')
            ->andWhere('e.surname = :surname')
            ->andWhere('e.email = :email')
            ->setParameter('name', $employeeDto->getName())
            ->setParameter('surname', $employeeDto->getSurname())
            ->setParameter('email', $employeeDto->getEmail())
            ->setParameter('companyId', $employeeDto->getCompanyId())
            ->getQuery()
            ->getSingleScalarResult();

        return $result > 0;
    }

    public function employeeExists(int $employeeId): bool
    {
        $result = $this->createQueryBuilder('e')
            ->select('count(e.id)')
            ->andWhere('e.id = :id')
            ->setParameter('id', $employeeId)
            ->getQuery()
            ->getSingleScalarResult();

        return $result > 0;
    }


    public function replaceEmployee(EmployeeDto $employeeDto): void
    {
        $employee = $this->getEmployeeById($employeeDto->getEmployeeId());

        if (!$employee instanceof Employee) {
            throw new \Exception('Employee not found');
        }

        $employee->setName($employeeDto->getName());
        $employee->setSurname($employeeDto->getSurname());
        $employee->setEmail($employeeDto->getEmail());
        $employee->setPhone($employeeDto->getPhone());

        $this->store($employee);
    }

    public function updateEmployee(EmployeeDto $employeeDto): void
    {
        $employee = $this->getEmployeeById($employeeDto->getEmployeeId());
        if (!$employee instanceof Employee) {
            throw new \Exception('Employee not found');
        }

        if ($employeeDto->getName() !== null) {
            $employee->setName($employeeDto->getName());
        }

        if ($employeeDto->getSurname() !== null) {
            $employee->setSurname($employeeDto->getSurname());
        }

        if ($employeeDto->getEmail() !== null) {
            $employee->setEmail($employeeDto->getEmail());
        }

        if ($employeeDto->getPhone() !== null) {
            $employee->setPhone($employeeDto->getPhone());
        }

        $this->store($employee);
    }

    public function deleteEmployee(int $employeeId): void
    {
        $employee = $this->getEmployeeById($employeeId);

        if (!$employee instanceof Employee) {
            throw new \Exception('Employee not found');
        }

        $entityManager = $this->getEntityManager();
        $entityManager->beginTransaction();

        $entityManager->remove($employee);
        $entityManager->commit();

        $entityManager->flush();
    }

    private function getEmployeeById(int $employeeId): ?Employee
    {
        return $this->createQueryBuilder('e')
            ->where('e.id = :id')
            ->setParameter('id', $employeeId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    private function store(Employee $employee): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->beginTransaction();

        $entityManager->persist($employee);
        $entityManager->commit();

        $entityManager->flush();
    }
}

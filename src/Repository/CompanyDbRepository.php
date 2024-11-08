<?php

declare(strict_types=1);

namespace App\Repository;

use App\Application\Shared\CompanyDto;
use App\Application\Shared\EmployeeDto;
use App\DomainModel\CompanyRepository;
use App\Entity\Company;
use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CompanyDbRepository extends ServiceEntityRepository implements CompanyRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    public function addCompany(Company $company): void
    {
        $this->store($company);
    }

    public function updateCompany(CompanyDto $companyDto): void
    {
        /** @var Company $storedCompany */
        $storedCompany = $this->getCompanyById($companyDto->getCompanyId());

        if (!$storedCompany instanceof Company) {
            throw new \Exception('Company not found.');
        }

        if ($companyDto->getTaxIdNumber() !== null) {
            $storedCompany->setTaxIdNumber($companyDto->getTaxIdNumber());
        }

        if ($companyDto->getName() !== null) {
            $storedCompany->setName($companyDto->getName());
        }

        if ($companyDto->getAddress() !== null) {
            $storedCompany->setAddress($companyDto->getAddress());
        }

        if ($companyDto->getCity() !== null) {
            $storedCompany->setCity($companyDto->getCity());
        }

        if ($companyDto->getPostalCode() !== null) {
            $storedCompany->setPostalCode($companyDto->getPostalCode());
        }

        $this->store($storedCompany);
    }


    public function companyTaxIdNumberExists(string $taxIdNumber): bool
    {
        $result = $this->createQueryBuilder('c')
            ->where('c.taxIdNumber = :val')
            ->setParameter('val', $taxIdNumber)
            ->setMaxResults(1)
            ->getQuery()
            ->getArrayResult();

        return !empty($result);
    }

    public function companyExists(int $companyId): bool
    {
        $result = $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->where('c.id = :id')
            ->setParameter('id', $companyId)
            ->getQuery()
            ->getSingleScalarResult();

        return $result > 0;
    }


    public function deleteCompany(int $companyId): void
    {
        $company = $this->getCompanyById($companyId);
        if (!$company instanceof Company) {
            throw new \Exception('Company not found');
        }

        $entityManager = $this->getEntityManager();
        $entityManager->beginTransaction();
        $entityManager->remove($company);
        $entityManager->commit();
        $entityManager->flush();
    }

    public function addEmployee(EmployeeDto $employeeDto): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->beginTransaction();

        $employee = new Employee();
        $employee->setName($employeeDto->getName());
        $employee->setSurname($employeeDto->getSurname());
        $employee->setEmail($employeeDto->getEmail());
        $employee->setPhone($employeeDto->getPhone());

        $entityManager->persist($employee);

        $company = $this->getCompanyById($employeeDto->getCompanyId());

        if (!$company instanceof Company) {
            throw new \Exception('Company not found');
        }
        $company->addEmployee($employee);

        $entityManager->persist($company);
        $entityManager->commit();

        $entityManager->flush();
    }

    private function store(Company $company): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->beginTransaction();
        $entityManager->persist($company);
        $entityManager->commit();

        $entityManager->flush();
    }

    private function getCompanyById(int $companyId): ?Company
    {
        return $this->createQueryBuilder('c')
            ->where('c.id = :id')
            ->setMaxResults(1)
            ->setParameter('id', $companyId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

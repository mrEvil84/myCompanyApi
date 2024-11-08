<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Application\Command\Company\AddCompany;
use App\Application\Exceptions\AddCompanyException;
use App\DomainModel\CompanyRepository;
use App\Entity\Company;

readonly class AddCompanyHandler
{
    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    public function handle(AddCompany $command): void
    {
        $this->assertCompanyNotExists($command);

        $company = new Company();

        $company->setTaxIdNumber($command->getTaxIdNumber());
        $company->setName($command->getName());
        $company->setAddress($command->getAddress());
        $company->setCity($command->getCity());
        $company->setPostalCode($command->getPostalCode());

        $this->companyRepository->addCompany($company);
    }

    private function assertCompanyNotExists(AddCompany $command): void
    {
        $taxIdNumberExists = $this->companyRepository->companyTaxIdNumberExists($command->getTaxIdNumber());
        if ($taxIdNumberExists) {
            throw AddCompanyException::companyAlreadyExists();
        }
    }
}

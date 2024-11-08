<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Application\Command\Company\ReplaceCompany;
use App\Application\Exceptions\ReplaceCompanyException;
use App\Application\Shared\CompanyDto;
use App\DomainModel\CompanyRepository;
use App\Entity\Company;

readonly class ReplaceCompanyHandler
{
    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    public function handle(ReplaceCompany $command): void
    {
        $this->assertTaxIdNumber($command->getTaxIdNumber());
        $this->assertCompanyExists($command);

        if ($this->companyRepository->companyTaxIdNumberExists($command->getTaxIdNumber())) {
            $this->replace($command);
        } else {
            $this->add($command);
        }
    }

    private function assertCompanyExists(ReplaceCompany $command): void
    {
        $taxIdNumberExists = $this->companyRepository->companyTaxIdNumberExists($command->getTaxIdNumber());
        if (!$taxIdNumberExists) {
            throw ReplaceCompanyException::companyNotFound();
        }
    }

    private function replace(ReplaceCompany $command): void
    {
        $this->companyRepository->updateCompany(CompanyDto::fromCommand($command));
    }

    private function add(ReplaceCompany $command): void
    {
        $this->companyRepository->addCompany($this->getEntity($command));
    }

    private function getEntity(ReplaceCompany $command): Company
    {
        $company = new Company();

        $company->setTaxIdNumber($command->getTaxIdNumber());
        $company->setName($command->getName());
        $company->setAddress($command->getAddress());
        $company->setCity($command->getCity());
        $company->setPostalCode($command->getPostalCode());

        return $company;
    }

    private function assertTaxIdNumber(string $getTaxIdNumber): void
    {
        if (strlen($getTaxIdNumber) < 10) {
            throw ReplaceCompanyException::taxIdNumberInvalid();
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Application\Handlers\Company;

use App\Application\Command\Company\ReplaceCompany;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use App\Application\Shared\CompanyDto;
use App\DomainModel\CompanyRepository;
use App\Entity\Company;

final readonly class ReplaceCompanyHandler
{
    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    public function handle(ReplaceCompany $command): void
    {
        $this->assertTaxIdNumber($command->getTaxIdNumber());

        if ($this->companyRepository->companyExists($command->getCompanyId())) {
            $this->companyRepository->updateCompany(CompanyDto::fromCommand($command));
        } else {
            $this->companyRepository->addCompany($this->getNewCompany($command));
        }
    }

    private function getNewCompany(ReplaceCompany $command): Company
    {
        $company = new Company();

        $company->setTaxIdNumber($command->getTaxIdNumber());
        $company->setName($command->getName());
        $company->setAddress($command->getAddress());
        $company->setCity($command->getCity());
        $company->setPostalCode($command->getPostalCode());

        return $company;
    }

    private function assertTaxIdNumber(string $taxIdNumber): void
    {
        if (strlen($taxIdNumber) !== 10) {
            throw CommandHandlerException::taxIdNumberInvalid();
        }
    }
}

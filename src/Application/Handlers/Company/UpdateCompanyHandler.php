<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Application\Command\Company\UpdateCompany;
use App\Application\Exceptions\UpdateCompanyException;
use App\Application\Shared\CompanyDto;
use App\DomainModel\CompanyRepository;

readonly class UpdateCompanyHandler
{
    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    public function handle(UpdateCompany $command): void
    {
        $this->assertTaxIdNumber($command->getTaxIdNumber());
        $this->assertCompanyExists($command);

        $this->update($command);
    }

    private function assertCompanyExists(UpdateCompany $command): void
    {
        $taxIdNumberExists = $this->companyRepository->companyTaxIdNumberExists($command->getTaxIdNumber());
        if (!$taxIdNumberExists) {
            throw UpdateCompanyException::companyNotFound();
        }
    }

    private function assertTaxIdNumber(string $getTaxIdNumber): void
    {
        if (strlen($getTaxIdNumber) < 10) {
            throw UpdateCompanyException::taxIdNumberInvalid();
        }
    }

    private function update(UpdateCompany $command): void
    {
        $updateDto = CompanyDto::fromUpdateCommand($command);
        $this->companyRepository->updateCompany($updateDto);
    }
}

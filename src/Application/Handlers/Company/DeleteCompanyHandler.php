<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Application\Command\Company\DeleteCompany;
use App\Application\Exceptions\DeleteCompanyException;
use App\DomainModel\CompanyRepository;

readonly class DeleteCompanyHandler
{
    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    public function handle(DeleteCompany $command): void
    {
        $this->assertTaxIdNumber($command->getTaxIdNumber());
        $this->assertCompanyExists($command);

        $this->delete($command);
    }

    private function assertCompanyExists(DeleteCompany $command): void
    {
        $taxIdNumberExists = $this->companyRepository->companyTaxIdNumberExists($command->getTaxIdNumber());
        if (!$taxIdNumberExists) {
            throw DeleteCompanyException::companyNotFound();
        }
    }

    private function assertTaxIdNumber(string $getTaxIdNumber): void
    {
        if (strlen($getTaxIdNumber) < 10) {
            throw DeleteCompanyException::taxIdNumberInvalid();
        }
    }

    private function delete(DeleteCompany $command): void
    {
        $this->companyRepository->deleteCompany($command->getTaxIdNumber());
    }
}

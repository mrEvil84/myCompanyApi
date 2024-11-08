<?php

declare(strict_types=1);

namespace App\Application\Handlers\Company;

use App\Application\Command\Company\UpdateCompany;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use App\Application\Shared\CompanyDto;
use App\DomainModel\CompanyRepository;

final readonly class UpdateCompanyHandler
{
    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    public function handle(UpdateCompany $command): void
    {
        $this->assertCompanyExists($command->getCompanyId());
        $this->assertTaxIdNumber($command->getTaxIdNumber());

        $this->update($command);
    }

    private function assertCompanyExists(int $companyId): void
    {
        $companyExists = $this->companyRepository->companyExists($companyId);
        if (!$companyExists) {
            throw CommandHandlerException::companyNotFound();
        }
    }

    private function assertTaxIdNumber(?string $taxIdNumber): void
    {
        if ($taxIdNumber !== null && strlen($taxIdNumber) < 10) {
            throw CommandHandlerException::taxIdNumberInvalid();
        }
    }

    private function update(UpdateCompany $command): void
    {
        $updateDto = CompanyDto::fromUpdateCommand($command);
        $this->companyRepository->updateCompany($updateDto);
    }
}

<?php

declare(strict_types=1);

namespace App\Tests\Application\Handlers\Company;

use App\Application\Command\Company\DeleteCompany;
use App\Application\Handlers\Company\DeleteCompanyHandler;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use App\Tests\Application\Handlers\HandlersBaseTestCase;
use PHPUnit\Framework\Attributes\Test;

class DeleteHandlerTest extends HandlersBaseTestCase
{
    #[Test]
    public function shouldHandleDeleteCompany(): void
    {
        $companyId = 123;
        $this->companyRepoMock->expects(self::once())->method('companyExists')->willReturn(true);
        $this->companyRepoMock->expects(self::once())->method('deleteCompany')->with($companyId);

        $sut = new DeleteCompanyHandler($this->companyRepoMock);

        $sut->handle(new DeleteCompany($companyId));
    }

    #[Test]
    public function shouldNotDeleteCompanyWhileCompanyNotExists(): void
    {
        $companyId = 123;
        $this->companyRepoMock->expects(self::once())->method('companyExists')->willReturn(false);

        $sut = new DeleteCompanyHandler($this->companyRepoMock);

        $this->expectException(CommandHandlerException::class);
        $this->expectExceptionMessage('Company not found.');
        $sut->handle(new DeleteCompany($companyId));
    }
}

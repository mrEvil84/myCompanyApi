<?php

declare(strict_types=1);

namespace App\Tests\Application\Handlers\Company;

use App\Application\Command\Company\UpdateCompany;
use App\Application\Handlers\Company\UpdateCompanyHandler;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use PHPUnit\Framework\Attributes\Test;

class UpdateCompanyHandlerTest extends CompanyHandlersBaseTestCase
{
    #[Test]
    public function shouldHandleUpdate(): void
    {
        $this->repositoryMock->expects(self::once())->method('companyExists')->willReturn(true);
        $this->repositoryMock->expects(self::once())->method('updateCompany');

        $sut = new UpdateCompanyHandler($this->repositoryMock);

        $sut->handle(new UpdateCompany(
            1234,
            null,
            'new name'
        ));
    }

    #[Test]
    public function shouldNotHandleWhenCompanyNotExists(): void
    {
        $this->repositoryMock->expects(self::once())->method('companyExists')->willReturn(false);

        $sut = new UpdateCompanyHandler($this->repositoryMock);

        $this->expectException(CommandHandlerException::class);
        $this->expectExceptionMessage('Company not found.');
        $sut->handle(new UpdateCompany(
            1234,
            null,
            'new name'
        ));
    }

    #[Test]
    public function shouldNotHandleWhenTaxIdIsInvalid(): void
    {
        $this->repositoryMock->expects(self::once())->method('companyExists')->willReturn(true);

        $sut = new UpdateCompanyHandler($this->repositoryMock);

        $this->expectException(CommandHandlerException::class);
        $this->expectExceptionMessage('Tax id number is invalid.');
        $sut->handle(new UpdateCompany(
            1234,
            '11234',
        ));
    }
}

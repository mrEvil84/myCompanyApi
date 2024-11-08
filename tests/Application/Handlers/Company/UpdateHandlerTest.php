<?php

declare(strict_types=1);

namespace App\Tests\Application\Handlers\Company;

use App\Application\Command\Company\UpdateCompany;
use App\Application\Handlers\Company\UpdateCompanyHandler;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use App\Tests\Application\Handlers\HandlersBaseTestCase;
use PHPUnit\Framework\Attributes\Test;

class UpdateHandlerTest extends HandlersBaseTestCase
{
    #[Test]
    public function shouldHandleUpdate(): void
    {
        $this->companyRepoMock->expects(self::once())->method('companyExists')->willReturn(true);
        $this->companyRepoMock->expects(self::once())->method('updateCompany');

        $sut = new UpdateCompanyHandler($this->companyRepoMock);

        $sut->handle(new UpdateCompany(
            1234,
            null,
            'new name'
        ));
    }

    #[Test]
    public function shouldNotHandleWhenCompanyNotExists(): void
    {
        $this->companyRepoMock->expects(self::once())->method('companyExists')->willReturn(false);

        $sut = new UpdateCompanyHandler($this->companyRepoMock);

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
        $this->companyRepoMock->expects(self::once())->method('companyExists')->willReturn(true);

        $sut = new UpdateCompanyHandler($this->companyRepoMock);

        $this->expectException(CommandHandlerException::class);
        $this->expectExceptionMessage('Tax id number is invalid.');
        $sut->handle(new UpdateCompany(
            1234,
            '11234',
        ));
    }
}

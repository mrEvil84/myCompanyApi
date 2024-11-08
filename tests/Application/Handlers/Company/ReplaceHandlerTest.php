<?php

declare(strict_types=1);

namespace App\Tests\Application\Handlers\Company;

use App\Application\Command\Company\ReplaceCompany;
use App\Application\Handlers\Company\ReplaceCompanyHandler;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use App\Tests\Application\Handlers\HandlersBaseTestCase;
use PHPUnit\Framework\Attributes\Test;

class ReplaceHandlerTest extends HandlersBaseTestCase
{
    #[Test]
    public function shouldReplace(): void
    {
        $companyId = 1234;
        $this
            ->companyRepoMock
            ->expects(self::once())
            ->method('companyExists')
            ->with($companyId)
            ->willReturn(true);

        $this
            ->companyRepoMock
            ->expects(self::once())
            ->method('updateCompany');

        $sut = new ReplaceCompanyHandler($this->companyRepoMock);

        $sut->handle(new ReplaceCompany(
            '1234567890',
            'company name',
            'company address',
            'city',
            '12-222',
            $companyId
        ));
    }

    #[Test]
    public function shouldAddNew(): void
    {
        $companyId = 1234;
        $this
            ->companyRepoMock
            ->expects(self::once())
            ->method('companyExists')
            ->with($companyId)
            ->willReturn(false);

        $this
            ->companyRepoMock
            ->expects(self::once())
            ->method('addCompany');

        $sut = new ReplaceCompanyHandler($this->companyRepoMock);

        $sut->handle(new ReplaceCompany(
            '1234567890',
            'company name',
            'company address',
            'city',
            '12-222',
            $companyId
        ));
    }

    #[Test]
    public function shouldNotHandleWhenTaxIdNumberInvalid(): void
    {
        $sut = new ReplaceCompanyHandler($this->companyRepoMock);

        $this->expectException(CommandHandlerException::class);
        $this->expectExceptionMessage('Tax id number is invalid');
        $sut->handle(new ReplaceCompany(
            '0',
            'company name',
            'company address',
            'city',
            '12-222',
            1234
        ));
    }
}

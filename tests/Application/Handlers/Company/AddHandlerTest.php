<?php

declare(strict_types=1);

namespace App\Tests\Application\Handlers\Company;

use App\Application\Command\Company\AddCompany;
use App\Application\Handlers\Company\AddCompanyHandler;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use App\Tests\Application\Handlers\HandlersBaseTestCase;
use PHPUnit\Framework\Attributes\Test;

class AddHandlerTest extends HandlersBaseTestCase
{
    #[Test]
    public function shouldHandle(): void
    {
        $this
            ->companyRepoMock
            ->expects($this->once())
            ->method('companyTaxIdNumberExists')
            ->willReturn(false);

        $sut = new AddCompanyHandler($this->companyRepoMock);

        $sut->handle(new AddCompany(
            '123',
            'Company name',
            'Company address',
            'Company city',
            '12-123'
        ));
    }

    #[Test]
    public function shouldNotHandleWhenCompanyNotExists(): void
    {
        $this
            ->companyRepoMock
            ->expects($this->once())
            ->method('companyTaxIdNumberExists')
            ->willReturn(true);

        $sut = new AddCompanyHandler($this->companyRepoMock);

        $this->expectException(CommandHandlerException::class);
        $this->expectExceptionMessage('Company already exists');

        $sut->handle(new AddCompany(
            '123',
            'Company name',
            'Company address',
            'Company city',
            '12-123'
        ));
    }
}

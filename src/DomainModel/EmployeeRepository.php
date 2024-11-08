<?php

declare(strict_types=1);

namespace App\DomainModel;

use App\Application\Shared\EmployeeDto;
use App\Entity\Employee;

interface EmployeeRepository
{
    public function getEmployeeByData(EmployeeDto $employeeDto): ?Employee;

    public function employeeExistsInCompany(EmployeeDto $employeeDto): bool;

    public function employeeExists(int $employeeId);

    public function replaceEmployee(EmployeeDto $employeeDto): void;

    public function updateEmployee(EmployeeDto $employeeDto): void;

    public function deleteEmployee(int $employeeId): void;
}

<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\Command\Employee\AddEmployee;
use App\Application\Command\Employee\EmployeeCommand;
use App\Application\EmployeeService;
use App\Controller\RequestDto\Employee\AddEmployeeDto;
use App\Controller\RequestDto\Employee\DeleteEmployeeDto;
use App\Controller\RequestDto\Employee\GetCompanyEmployeesDto;
use App\Controller\RequestDto\Employee\GetEmployeeDto;
use App\Controller\RequestDto\Employee\ReplaceAddEmployeeDto;
use App\Controller\RequestDto\Employee\UpdateEmployeeDto;
use App\ReadModel\EmployeeReadModel;
use App\ReadModel\Query\GetCompanyExmployees;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
    public function __construct(
        private readonly EmployeeService $employeeService,
        private readonly EmployeeReadModel $employeeReadModel,
    ) {
    }

    #[Route('/api/employee', name: 'api_add_company_employee', methods: ['POST'])]
    public function addEmployee(#[MapRequestPayload] AddEmployeeDto $employeeDto): Response
    {
        $command = new AddEmployee(
            $employeeDto->companyId,
            null,
            $employeeDto->name,
            $employeeDto->surname,
            $employeeDto->email,
            $employeeDto->phone,
        );

        try {
            $this->employeeService->add($command);
            return $this->json([], Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/api/employee', name: 'api_replace_company_employee', methods: ['PUT'])]
    public function replaceEmployee(#[MapRequestPayload] ReplaceAddEmployeeDto $employeeDto): Response
    {
        try {
            $command = new EmployeeCommand(
                $employeeDto->companyId,
                $employeeDto->employeeId,
                $employeeDto->surname,
                $employeeDto->email,
                $employeeDto->phone,
            );

            $this->employeeService->replace($command);
            return $this->json([], Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/api/employee', name: 'api_update_company_employee', methods: ['PATCH'])]
    public function updateEmployee(#[MapRequestPayload] UpdateEmployeeDto $employeeDto): Response
    {
        try {
            $command = new EmployeeCommand(
                $employeeDto->companyId,
                $employeeDto->employeeId,
                $employeeDto->name,
                $employeeDto->surname,
                $employeeDto->email,
                $employeeDto->phone,
            );

            $this->employeeService->update($command);
            return $this->json([], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/api/employee', name: 'api_delete_employee', methods: ['DELETE'])]
    public function deleteEmployee(#[MapRequestPayload] DeleteEmployeeDto $deleteEmployeeDto): Response
    {
        try {
            $this->employeeService->delete($deleteEmployeeDto->employeeId);
            return $this->json([], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route(
        '/api/employees/{limit}/{offset}',
        name: 'get company employees',
        requirements: ['limit' => '\d+', 'offset' => '\d+'],
        defaults: ['limit' => 10, 'offset' => 0],
        methods: ['GET']
    )]
    public function getCompanyEmployees(
        #[MapRequestPayload] GetCompanyEmployeesDto $companyEmployeesDto,
        int $limit = 10,
        int $offset = 0
    ): Response {
        $query = new GetCompanyExmployees($companyEmployeesDto->companyId, $limit, $offset);
        $employees = $this->employeeReadModel->getCompanyEmployees($query);

        return $this->json($employees);
    }

    #[Route(
        '/api/employee',
        name: 'get employee details',
        methods: ['GET']
    )]
    public function getEmployeeDetails(
        #[MapRequestPayload] GetEmployeeDto $employeeDto,
    ): Response {
        $employee = $this->employeeReadModel->getEmployee($employeeDto->employeeId);
        return $this->json($employee);
    }
}

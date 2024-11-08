<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\CompanyService;
use App\Controller\RequestDto\Company\AddCompanyDto;
use App\Controller\RequestDto\Company\DeleteCompanyDto;
use App\Controller\RequestDto\Company\GetCompanyDetailsDto;
use App\Controller\RequestDto\Company\ReplaceCompanyDto;
use App\Controller\RequestDto\Company\UpdateCompanyDto;
use App\ReadModel\CompanyReadModel;
use App\ReadModel\Query\GetCompanies;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class MyCompanyController extends AbstractController
{
    public function __construct(
        private readonly CompanyService $companyService,
        private readonly CompanyReadModel $companyReadModel,
    ) {
    }

    #[Route(
        '/api/companies/{limit}/{offset}',
        name: 'get companies',
        requirements: ['limit' => '\d+', 'offset' => '\d+'],
        defaults: ['limit' => 10, 'offset' => 0],
        methods: ['GET']
    )]
    public function getCompanyCollection(int $limit, int $offset): Response
    {
        $query = new GetCompanies($limit, $offset);
        return $this->json($this->companyReadModel->getCompanies($query));
    }

    #[Route(
        '/api/company',
        name: 'get company details',
        methods: ['GET']
    )]
    public function getCompanyDetails(#[MapRequestPayload] GetCompanyDetailsDto $companyDetailsDto): Response
    {
        return $this->json($this->companyReadModel->getCompany($companyDetailsDto->taxIdNumber));
    }

    #[Route('/api/company', name: 'api_add_company', methods: ['POST'])]
    public function addCompany(#[MapRequestPayload] AddCompanyDto $addCompanyDto): Response
    {
        try {
            $this->companyService->addCompany($addCompanyDto->getCommand());
            return $this->json([], Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/api/company', name: 'api_replace_company', methods: ['PUT'])]
    public function replaceCompany(#[MapRequestPayload] ReplaceCompanyDto $replaceCompanyDto): Response
    {
        try {
            $this->companyService->replaceCompany($replaceCompanyDto->getCommand());
            return $this->json([], Response::HTTP_ACCEPTED);
        } catch (\Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/api/company', name: 'api_update_company', methods: ['PATCH'])]
    public function updateCompany(#[MapRequestPayload] UpdateCompanyDto $updateCompanyDto): Response
    {
        try {
            $this->companyService->updateCompany($updateCompanyDto->getCommand());
            return $this->json([], Response::HTTP_ACCEPTED);
        } catch (\Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/api/company', name: 'api_delete_company', methods: ['DELETE'])]
    public function deleteCompany(#[MapRequestPayload] DeleteCompanyDto $deleteCompanyDto): Response
    {
        try {
            $this->companyService->deleteCompany($deleteCompanyDto->getCommand());
            return $this->json([], Response::HTTP_ACCEPTED);
        } catch (\Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}

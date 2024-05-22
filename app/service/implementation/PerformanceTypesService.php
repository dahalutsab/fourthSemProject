<?php

namespace App\service\implementation;

use App\dto\request\PerformanceTypeRequest;
use App\dto\response\PerformanceTypesResponse;
use App\repository\implementation\PerformanceTypesRepository;

class PerformanceTypesService
{
    private PerformanceTypesRepository $performanceTypeRepository;

    public function __construct()
    {
        $this->performanceTypeRepository = new PerformanceTypesRepository;
    }

    /**
     * @throws \Exception
     */
    public function saveArtistPerformance(PerformanceTypeRequest $performanceTypeRequest): PerformanceTypesResponse
    {
        if ($performanceTypeRequest->getPerformanceType() == null ||  $performanceTypeRequest->getCostPerHour() == null) {
            throw new \InvalidArgumentException("All fields are required");
        }
        $performanceType = $this->performanceTypeRepository->saveArtistPerformance($performanceTypeRequest);
        return new PerformanceTypesResponse($performanceType->getPerformanceTypeId(), $performanceType->getPerformanceType(), $performanceType->getArtistId(), $performanceType->getCostPerHour(), $performanceType->isDeleted());
    }

    public function getArtistPerformance(float|int|string $id): array
    {
        if (!is_numeric($id)) {
            throw new \InvalidArgumentException("Invalid artist ID: $id");
        }
        $performanceTypes = $this->performanceTypeRepository->getPerformanceTypesOfArtist($id);
        $response = [];
        foreach ($performanceTypes as $performanceType) {
            $responses = new PerformanceTypesResponse($performanceType->getPerformanceTypeId(), $performanceType->getPerformanceType(), $performanceType->getArtistId(), $performanceType->getCostPerHour(), $performanceType->isDeleted());
            $response[] = $responses->toArray();
        }
        return $response;
    }

    public function updateArtistPerformance(int $id, PerformanceTypeRequest $performanceTypeRequest): PerformanceTypesResponse
    {
        if ($performanceTypeRequest->getPerformanceType() == null ||  $performanceTypeRequest->getCostPerHour() == null) {
            throw new \InvalidArgumentException("All fields are required");
        }
        $performanceType = $this->performanceTypeRepository->updateArtistPerformance($id, $performanceTypeRequest);
        return new PerformanceTypesResponse($performanceType->getPerformanceTypeId(), $performanceType->getPerformanceType(), $performanceType->getArtistId(), $performanceType->getCostPerHour(), $performanceType->isDeleted());
    }

    public function deleteArtistPerformance(int $id): void
    {
        $this->performanceTypeRepository->deleteArtistPerformance($id);
    }
}

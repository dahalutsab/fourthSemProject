<?php

namespace app\service\implementation;

use app\dto\request\PerformanceTypeRequest;
use app\dto\response\PerformanceTypesResponse;
use app\repository\implementation\PerformanceTypesRepository;

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

    public function getCostPerHour(float|int|string $id, $eventStartTime, $eventEndTime): array
    {
        if (!is_numeric($id)) {
            throw new \InvalidArgumentException("Invalid performance type ID: $id");
        }

        // Retrieve the cost per hour for the given performance type
        $cost = $this->performanceTypeRepository->getCostPerHour($id);

        // Convert start and end times to timestamps
        $eventStartTime = strtotime($eventStartTime);
        $eventEndTime = strtotime($eventEndTime);

        // Ensure start time is before end time
        if ($eventStartTime > $eventEndTime) {
            $eventEndTime += 86400; // Add 24 hours (in seconds)
        }

        // Calculate duration in hours
        $hours = ($eventEndTime - $eventStartTime) / 3600;

        // Compute total cost
        $totalCost = $cost * $hours;

        // Determine advance amount (25% of total cost)
        $advanceAmount = $totalCost * 0.25;

        // Format amounts with two decimal places
        $totalCostFormatted = number_format($totalCost, 2);
        $advanceAmountFormatted = number_format($advanceAmount, 2);

        // Calculate remaining amount
        $remainingAmount = $totalCost - $advanceAmount;
        $remainingAmountFormatted = number_format($remainingAmount, 2);

        return [
            'totalCost' => $totalCostFormatted,
            'advanceAmount' => $advanceAmountFormatted,
            'remainingAmount' => $remainingAmountFormatted,
        ];
    }

    public function getArtistPerformanceByArtistDetails(float|int|string $artistId)
    {
        if (!is_numeric($artistId)) {
            throw new \InvalidArgumentException("Invalid artist ID: $artistId");
        }
        $performanceTypes = $this->performanceTypeRepository->getArtistPerformanceByArtistDetails($artistId);
        $response = [];
        foreach ($performanceTypes as $performanceType) {
            $responses = new PerformanceTypesResponse($performanceType->getPerformanceTypeId(), $performanceType->getPerformanceType(), $performanceType->getArtistId(), $performanceType->getCostPerHour(), $performanceType->isDeleted());
            $response[] = $responses->toArray();
        }
        return $response;
    }

}

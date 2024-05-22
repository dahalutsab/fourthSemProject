<?php

namespace App\service\implementation;

use App\dto\request\ArtistPerformanceRequest;
use App\dto\response\ArtistPerformanceResponse;
use App\repository\implementation\ArtistPerformanceRepository;
use App\repository\implementation\LocationRepository;

class ArtistPerformanceService
{
    private ArtistPerformanceRepository $artistPerformanceRepository;
    private LocationRepository $locationRepository;

    public function __construct()
    {
        $this->artistPerformanceRepository = new ArtistPerformanceRepository;
    }

    public function saveArtistPerformance(ArtistPerformanceRequest $artistPerformanceRequest): ArtistPerformanceResponse
    {
        if ($artistPerformanceRequest->getArtistId() == null || $artistPerformanceRequest->getPerformanceTypeId() == null || $artistPerformanceRequest->getDurationHours() == null || $artistPerformanceRequest->getDate() == null || $artistPerformanceRequest->getEventName() == null || $artistPerformanceRequest->getUserId() == null || $artistPerformanceRequest->getLocationRequest() == null) {
            throw new \InvalidArgumentException("All fields are required");
        }
        $savedLocation = $this->locationRepository->saveLocation($artistPerformanceRequest->getLocationRequest());
        $artistPerformance = $this->artistPerformanceRepository->saveArtistPerformance($artistPerformanceRequest, $savedLocation);
        return new ArtistPerformanceResponse($artistPerformance->getArtistPerformanceId(), $artistPerformance->getArtistId(), $artistPerformance->getPerformanceTypeId(), $artistPerformance->getDurationHours(), $artistPerformance->getDate(), $artistPerformance->getEventName(), $artistPerformance->getUserId(), $artistPerformance->getLocationId());
    }

}
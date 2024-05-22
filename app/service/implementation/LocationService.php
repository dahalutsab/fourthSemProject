<?php

namespace App\service\implementation;

use App\repository\implementation\LocationRepository;

class LocationService
{
    private LocationRepository $locationRepository;

    public function __construct()
    {
        $this->locationRepository = new LocationRepository;
    }

    public function saveLocation(\App\dto\request\LocationRequest $locationRequest): int|string
    {
        return $this->locationRepository->saveLocation($locationRequest);
    }

    public function getAllProvinces(): array
    {
        return $this->locationRepository->getAllProvinces();
    }

    public function getAllDistrictsByProvinceId(int $provinceId): array
    {
        return $this->locationRepository->getAllDistrictsByProvinceId($provinceId);
    }

    public function getAllMunicipalitiesByDistrictId(int $districtId): array
    {
        return $this->locationRepository->getAllMunicipalitiesByDistrictId($districtId);
    }

}
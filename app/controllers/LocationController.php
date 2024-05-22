<?php

namespace App\controllers;

use App\Response\ApiResponse;
use App\service\implementation\LocationService;
use Exception;

class LocationController
{

    private LocationService $locationService;
    public function __construct()
    {
        $this->locationService = new LocationService;
    }

    public function getAllProvinces(): void
    {
        try {
            $provinces = $this->locationService->getAllProvinces();
            ApiResponse::success($provinces);
        } catch (\Exception $e) {
            ApiResponse::error($e->getMessage());
        }
    }

    public function getDistrictsByProvinceId(): void
    {
        try {
            $requestUri = $_SERVER['REQUEST_URI'];
            $uriPath = parse_url($requestUri, PHP_URL_PATH);
            $pathSegments = explode('/', $uriPath);

            $provinceId = end($pathSegments);
            if (!is_numeric($provinceId)) {
                throw new Exception("Invalid Province ID: $provinceId");
            }
            $districts = $this->locationService->getAllDistrictsByProvinceId($provinceId);
            ApiResponse::success($districts);
        } catch (\Exception $e) {
            ApiResponse::error($e->getMessage());
        }
    }

public function getMunicipalitiesByDistrictId(): void
{
        try {
            $requestUri = $_SERVER['REQUEST_URI'];
            $uriPath = parse_url($requestUri, PHP_URL_PATH);
            $pathSegments = explode('/', $uriPath);
            $districtId = end($pathSegments);
            $municipalities = $this->locationService->getAllMunicipalitiesByDistrictId($districtId);
            ApiResponse::success($municipalities);
        } catch (\Exception $e) {
            ApiResponse::error($e->getMessage());
        }
    }

    public function saveLocation()
    {
        try {
            $locationRequest = json_decode(file_get_contents('php://input'));
            $locationId = $this->locationService->saveLocation($locationRequest);
            ApiResponse::success($locationId);
        } catch (\Exception $e) {
            ApiResponse::error($e->getMessage());
        }
    }
}


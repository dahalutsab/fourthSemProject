<?php

namespace App\controllers;

use App\dto\request\PerformanceTypeRequest;
use App\Response\ApiResponse;
use App\service\implementation\PerformanceTypesService;
use Exception;

class PerformanceTypesController
{
    private PerformanceTypesService $performanceTypesService;

    public function __construct()
    {
        $this->performanceTypesService = new PerformanceTypesService();
    }

    public function saveArtistPerformance(): null
    {
        try {
            $performanceTypeRequest = new PerformanceTypeRequest(
                $_POST['performance_type'],
                $_POST['artist_id'],
                $_POST['cost_per_hour']
            );
            $response = $this->performanceTypesService->saveArtistPerformance($performanceTypeRequest);
            return ApiResponse::success($response->toArray(), "Performance type added successfully");
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }

    public function getArtistPerformance(): null
    {
        try {
            $requestUri = $_SERVER['REQUEST_URI'];
            $uriPath = parse_url($requestUri, PHP_URL_PATH);
            $pathSegments = explode('/', $uriPath);

            $id = end($pathSegments);
            if (!is_numeric($id)) {
                throw new Exception("Invalid artist ID: $id");
            }

            $response = $this->performanceTypesService->getArtistPerformance($id);
            return ApiResponse::success($response, "Performance types fetched successfully");
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }

    public function updateArtistPerformance(): null
    {
        try {
            $requestUri = $_SERVER['REQUEST_URI'];
            $uriPath = parse_url($requestUri, PHP_URL_PATH);
            $pathSegments = explode('/', $uriPath);

            $id = end($pathSegments);
            if (!is_numeric($id)) {
                throw new Exception("Invalid performance type ID: $id");
            }

            $data = json_decode(file_get_contents('php://input'), true);
            $performanceTypeRequest = new PerformanceTypeRequest(
                $data['performance_type'],
                $data['artist_id'],
                $data['cost_per_hour']
            );

            $response = $this->performanceTypesService->updateArtistPerformance($id, $performanceTypeRequest);
            return ApiResponse::success($response->toArray(), "Performance type updated successfully");
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }

    public function deleteArtistPerformance(): null
    {
        try {
            $requestUri = $_SERVER['REQUEST_URI'];
            $uriPath = parse_url($requestUri, PHP_URL_PATH);
            $pathSegments = explode('/', $uriPath);

            $id = end($pathSegments);
            if (!is_numeric($id)) {
                throw new Exception("Invalid performance type ID: $id");
            }

            $this->performanceTypesService->deleteArtistPerformance($id);
            return ApiResponse::success(null, "Performance type deleted successfully");
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }

    public function getCostPerHour()
    {
        try {
            // Get the JSON payload from the POST request
            $postData = json_decode(file_get_contents('php://input'), true);

            if (!$postData) {
                throw new Exception("Invalid input");
            }

            $requestUri = $_SERVER['REQUEST_URI'];
            $uriPath = parse_url($requestUri, PHP_URL_PATH);
            $pathSegments = explode('/', $uriPath);

            $id = end($pathSegments);
            if (!is_numeric($id)) {
                throw new Exception("Invalid performance type ID: $id");
            }

            // Extract event times from the POST data
            $eventStartTime = $postData['eventStartTime'];
            $eventEndTime = $postData['eventEndTime'];

            // Call the service method to get the cost per hour
            $response = $this->performanceTypesService->getCostPerHour($id, $eventStartTime, $eventEndTime);

            return ApiResponse::success($response, "Cost for the performance fetched successfully");
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }


}

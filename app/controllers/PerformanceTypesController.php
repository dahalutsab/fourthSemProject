<?php

namespace app\controllers;

use app\dto\request\PerformanceTypeRequest;
use app\response\APIResponse;
use app\service\implementation\PerformanceTypesService;
use Exception;

class PerformanceTypesController
{
    private PerformanceTypesService $performanceTypesService;

    public function __construct()
    {
        $this->performanceTypesService = new PerformanceTypesService();
    }

    public function saveArtistPerformance(): void
    {
        try {
            $performanceTypeRequest = new PerformanceTypeRequest(
                $_POST['performance_type'],
                $_POST['artist_id'],
                $_POST['cost_per_hour']
            );
            $response = $this->performanceTypesService->saveArtistPerformance($performanceTypeRequest);
             APIResponse::success($response->toArray(), "Performance type added successfully");
        } catch (\Exception $e) {
             APIResponse::error($e->getMessage());
        }
    }

    public function getArtistPerformance(): void
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
             APIResponse::success($response, "Performance types fetched successfully");
        } catch (\Exception $e) {
             APIResponse::error($e->getMessage());
        }
    }

    public function getArtistPerformanceByArtistDetails(): void
    {
        try {
            $requestUri = $_SERVER['REQUEST_URI'];
            $uriPath = parse_url($requestUri, PHP_URL_PATH);
            $pathSegments = explode('/', $uriPath);

            $artistId = end($pathSegments);
            if (!is_numeric($artistId)) {
                throw new Exception("Invalid artist ID: $artistId");
            }

            $response = $this->performanceTypesService->getArtistPerformanceByArtistDetails($artistId);
             APIResponse::success($response, "Performance types fetched successfully");
        } catch (\Exception $e) {
             APIResponse::error($e->getMessage());
        }
    }

    public function updateArtistPerformance(): void
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
             APIResponse::success($response->toArray(), "Performance type updated successfully");
        } catch (\Exception $e) {
             APIResponse::error($e->getMessage());
        }
    }

    public function deleteArtistPerformance(): void
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
             APIResponse::success(null, "Performance type deleted successfully");
        } catch (\Exception $e) {
             APIResponse::error($e->getMessage());
        }
    }

    public function getCostPerHour(): void
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

             APIResponse::success($response, "Cost for the performance fetched successfully");
        } catch (\Exception $e) {
             APIResponse::error($e->getMessage());
        }
    }


}

<?php

namespace App\controllers;

use App\Response\ApiResponse;
use App\service\CategoryServiceInterface;
use App\service\implementation\CategoryService;
use Exception;

class CategoryController
{
    protected CategoryServiceInterface $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    /**
     * @throws Exception
     */
    public function getAllCategories(): void
    {
        try {
            $categories = $this->categoryService->getAllCategories();
            ApiResponse::success($categories);
        } catch (Exception $e) {
            ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * @throws Exception
     */
    public static function getCategoryById(): void
    {
        if (!isset($_GET['id']) || $_GET['id'] === 'N/A') {
            ApiResponse::error('Category ID is required', 400);
            return;
        }

        $categoryId = $_GET['id'];

        echo "category id: " .$categoryId;
        // Create an instance of CategoryService
        $categoryService = new CategoryService();

        // Fetch the category by its ID
        $category = $categoryService->getCategoryById($categoryId);

        if (!$category) {
            ApiResponse::error('Category not found', 404);
            return;
        }

        // Return the category data in the response
        ApiResponse::success($category);
    }
}

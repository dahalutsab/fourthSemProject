<?php

namespace app\controllers;

use app\response\APIResponse;
use app\service\CategoryServiceInterface;
use app\service\implementation\CategoryService;
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
            APIResponse::success($categories);
        } catch (Exception $e) {
            APIResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * @throws Exception
     */
    public static function getCategoryById(): void
    {
        if (!isset($_GET['id']) || $_GET['id'] === 'N/A') {
            APIResponse::error('Category ID is required', 400);
            return;
        }

        $categoryId = $_GET['id'];

        echo "category id: " .$categoryId;
        // Create an instance of CategoryService
        $categoryService = new CategoryService();

        // Fetch the category by its ID
        $category = $categoryService->getCategoryById($categoryId);

        if (!$category) {
            APIResponse::error('Category not found', 404);
            return;
        }

        // Return the category data in the response
        APIResponse::success($category);
    }
}

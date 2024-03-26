<?php

namespace App\service\implementation;

use App\repository\implementation\CategoryRepository;
use App\service\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    protected CategoryRepository $categoryRepository;

    public function __construct() {
        $this->categoryRepository = new CategoryRepository;
    }

    /**
     * @throws \Exception
     */
    public function getAllCategories(): array
    {
        return$this->categoryRepository->getAllCategories();
    }

    public function getCategoryById(int $categoryId)
    {
        return $this->categoryRepository->getCategoryById($categoryId);
    }

}
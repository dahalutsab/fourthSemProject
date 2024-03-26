<?php
namespace App\repository\implementation;

use config\Database;
use Exception;

class CategoryRepository
{
    protected Database $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    /**
     * @throws Exception
     */
    public function getAllCategories(): array
    {
        try {
            $query = "SELECT * FROM categories";
            $statement = $this->database->getConnection()->prepare($query);
            if (!$statement) {
                throw new Exception("Error preparing statement: " . $this->database->getConnection()->error);
            }

            if (!$statement->execute()) {
                throw new Exception("Error executing statement: " . $statement->error);
            }

            $result = $statement->get_result();

            $categories = [];
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }

            return $categories;
        } catch (Exception $exception) {
            throw new Exception("Error fetching categories: " . $exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function getCategoryById(int $categoryId): ?array
    {
        try {
            $query = "SELECT * FROM categories WHERE id = ?";
            $statement = $this->database->getConnection()->prepare($query);
            if (!$statement) {
                throw new Exception("Error preparing statement: " . $this->database->getConnection()->error);
            }

            $statement->bind_param("i", $categoryId);

            if (!$statement->execute()) {
                throw new Exception("Error executing statement: " . $statement->error);
            }

            $result = $statement->get_result();

            $category = $result->fetch_assoc();

            if (!$category) {
                return null; // Category not found
            }

            return $category;
        } catch (Exception $exception) {
            throw new Exception("Error fetching category by ID: " . $exception->getMessage());
        }
    }
}

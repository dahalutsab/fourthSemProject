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
            // Log or handle the exception
            return [];
        }
    }
}

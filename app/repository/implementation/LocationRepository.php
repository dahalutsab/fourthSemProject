<?php

namespace app\repository\implementation;

use config\Database;

class LocationRepository
{
    protected Database $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function saveLocation(\app\dto\request\LocationRequest $locationRequest): int|string
    {
        // Prepare an SQL INSERT statement
        $sql = "INSERT INTO locations (municipality_id, location_name) VALUES ( ?, ?)";

        // Use the Database class's method to execute the SQL statement
        $this->db->getConnection()->prepare($sql)->execute([$locationRequest->getMunicipalityId(), $locationRequest->getLocationName()]);

        // Return the id
        return $this->db->getConnection()->insert_id;
    }

    public function getAllProvinces(): array
    {
        $sql = "SELECT * FROM provinces";
        $result = $this->db->getConnection()->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllDistrictsByProvinceId(int $provinceId): array
    {
        $sql = "SELECT * FROM districts WHERE province_id = ?";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bind_param("i", $provinceId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllMunicipalitiesByDistrictId(int $districtId): array
    {
        $sql = "SELECT * FROM municipalities WHERE district_id = ?";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bind_param("i", $districtId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
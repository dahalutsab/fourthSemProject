<?php

namespace App\repository\implementation;

use config\Database;

class LocationRepository
{
    protected Database $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function saveLocation(\App\dto\request\LocationRequest $locationRequest): int|string
    {
        // Prepare an SQL INSERT statement
        $sql = "INSERT INTO locations (municipality_id, location_name) VALUES ( ?, ?)";

        // Use the Database class's method to execute the SQL statement
        $this->db->getConnection()->prepare($sql)->execute([$locationRequest->getMunicipalityId(), $locationRequest->getLocationName()]);

        // Return the id
        return $this->db->getConnection()->insert_id;
    }
}
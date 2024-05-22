<?php

namespace App\repository\implementation;

use App\dto\request\ArtistPerformanceRequest;
use config\Database;

class ArtistPerformanceRepository
{
    protected Database $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function saveArtistPerformance(ArtistPerformanceRequest $artistPerformanceRequest, int|string $locationId): int|string
    {
        // Prepare an SQL INSERT statement
        $sql = "INSERT INTO artist_performance (artist_id, performance_type_id, duration_hours, date, event_name, user_id, location_id) VALUES ( ?, ?, ?, ?, ?, ?, ?)";

        // Use the Database class's method to execute the SQL statement
        $this->db->getConnection()->prepare($sql)->execute([$artistPerformanceRequest->getArtistId(), $artistPerformanceRequest->getPerformanceTypeId(), $artistPerformanceRequest->getDurationHours(), $artistPerformanceRequest->getDate(), $artistPerformanceRequest->getEventName(), $artistPerformanceRequest->getUserId(), $locationId]);

        // Return the id
        return $this->db->getConnection()->insert_id;
    }

    public function getArtistPerformance(int $artistId): array
    {
        // Prepare an SQL SELECT statement
        $sql = "SELECT artist_performance_id, artist_id, performance_type_id, duration_hours, date, event_name, user_id, location_id FROM artist_performance WHERE artist_id = ?";

        // Use the Database class's method to execute the SQL statement
        // Return the result
        $result =  $this->db->getConnection()->prepare($sql)->execute([$artistId]);
        return $result;
    }

}
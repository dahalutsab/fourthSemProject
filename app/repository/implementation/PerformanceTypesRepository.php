<?php

namespace app\repository\implementation;

use app\dto\request\PerformanceTypeRequest;
use app\models\PerformanceTypes;
use config\Database;
use Exception;

class PerformanceTypesRepository
{
    protected Database $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPerformanceTypesOfArtist(int $artistId): array
    {
        $stmt = $this->db->getConnection()->prepare(
        "SELECT performance_type_id, performance_type, artist_id, cost_per_hour, is_deleted FROM performance_types WHERE artist_id = ?"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }

        $stmt->bind_param("i", $artistId);
        $stmt->execute();
        $result = $stmt->get_result();
        $performanceTypes = [];

        while ($row = $result->fetch_assoc()) {
            $performanceTypes[] = new PerformanceTypes(
                $row['performance_type_id'],
                $row['performance_type'],
                $row['artist_id'],
                $row['cost_per_hour'],
                $row['is_deleted']
            );
        }

        return $performanceTypes;
    }

    public function saveArtistPerformance(PerformanceTypeRequest $performanceTypeRequest): PerformanceTypes
    {
        $stmt = $this->db->getConnection()->prepare("SELECT id FROM users WHERE id = ?");
        $artistId1 = $performanceTypeRequest->getArtistId();
        $stmt->bind_param("i", $artistId1);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Invalid artist ID: " . $artistId1);
        }

        $stmt = $this->db->getConnection()->prepare(
            "INSERT INTO performance_types (performance_type, artist_id, cost_per_hour) VALUES (?, ?, ?)"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }

        $performanceType = $performanceTypeRequest->getPerformanceType();
        $artistId = $artistId1;
        $costPerHour = $performanceTypeRequest->getCostPerHour();
        $stmt->bind_param("sid", $performanceType, $artistId, $costPerHour);
        $stmt->execute();

        return new PerformanceTypes(
            $stmt->insert_id,
            $performanceType,
            $artistId,
            $costPerHour
        );
    }

    public function updateArtistPerformance(int $id, PerformanceTypeRequest $performanceTypeRequest): PerformanceTypes
    {
        $stmt = $this->db->getConnection()->prepare(
            "UPDATE performance_types SET performance_type = ?, cost_per_hour = ? WHERE performance_type_id = ?"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }

        $performanceType = $performanceTypeRequest->getPerformanceType();
        $costPerHour = $performanceTypeRequest->getCostPerHour();


        $stmt->bind_param("sdi", $performanceType, $costPerHour, $id);
        $stmt->execute();

        $stmt->execute();

// Fetch the updated record
        $stmt = $this->db->getConnection()->prepare(
            "SELECT performance_type, artist_id, cost_per_hour, is_deleted FROM performance_types WHERE performance_type_id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return new PerformanceTypes(
            $id,
            $row['performance_type'],
            $row['artist_id'],
            $row['cost_per_hour'],
            $row['is_deleted']
        );
    }

    public function deleteArtistPerformance(int $id): void
    {
        $stmt = $this->db->getConnection()->prepare(
            "UPDATE performance_types SET is_deleted = 1 WHERE performance_type_id = ?"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function getCostPerHour(float|int|string $id)
    {
        $stmt = $this->db->getConnection()->prepare(
            "SELECT cost_per_hour FROM performance_types WHERE performance_type_id = ?"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['cost_per_hour'];
    }

    public function getArtistPerformanceByArtistDetails(float|int|string $artistId)
    {
        $query = "SELECT user_id FROM artist_details WHERE id = ?";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bind_param("i", $artistId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $userId = $row['user_id'];


        $stmt = $this->db->getConnection()->prepare(
            "SELECT performance_type_id, performance_type, artist_id, cost_per_hour, is_deleted FROM performance_types WHERE artist_id = ? and is_deleted = 0"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }

        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $performanceTypes = [];

        while ($row = $result->fetch_assoc()) {
            $performanceTypes[] = new PerformanceTypes(
                $row['performance_type_id'],
                $row['performance_type'],
                $row['artist_id'],
                $row['cost_per_hour']
            );
        }

        return $performanceTypes;

    }
}

<?php

namespace app\repository\implementation;

use config\Database;

 class RequiredFieldsForArtists
{
    protected Database $db;
    protected string $artistId;

    public function __construct()
    {
        $this->artistId = $_SESSION[SESSION_USER_ID];
        $this->db = new Database;
        $this->getRequiredFieldsForArtistDetails();
        $this->getRequiredFieldsForMedia();
        $this->getRequiredFieldsForPerformanceType();
    }

    public function getRequiredFieldsForArtistDetails(): array
    {
        $sql = "SELECT * FROM artist_details WHERE user_id = ?";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bind_param("i", $this->artistId);
        $stmt->execute();
        $result = $stmt->get_result();
        $artistDetails = $result->fetch_assoc();

        $message = [];
        if (empty($artistDetails['full_name'])){
            $message[] = "Full Name";
        }

        if (empty($artistDetails['phone'])){
            $message[] = "Phone Number";
        }

        if (empty($artistDetails['address'])){
            $message[] = "Address";
        }

        if (empty($artistDetails['category_id'])){
            $message[] = "Category";
        }

        if (empty($artistDetails['description'])){
            $message[] = "Description";
        }

        return $message;
    }

    public function getRequiredFieldsForMedia(): array
    {
        $sql = "SELECT COUNT(*) FROM media WHERE user_id = ?";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bind_param("i", $this->artistId);
        $stmt->execute();
        $result = $stmt->get_result();
        $mediaCount = $result->fetch_assoc();

        $message = [];
        if ($mediaCount['COUNT(*)'] == 0){
            $message[] = "Upload at least 3 media files";
        }
        else if ($mediaCount['COUNT(*)'] < 3){
            $message[] = "Upload at least ".(3 - $mediaCount['COUNT(*)'])." more media files";
        }

        return $message;
    }

    public function getRequiredFieldsForPerformanceType(): array
    {
        $sql = "SELECT COUNT(*) FROM performance_types WHERE artist_id = ? And is_deleted = 0";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bind_param("i", $this->artistId);
        $stmt->execute();
        $result = $stmt->get_result();
        $performanceTypeCount = $result->fetch_assoc();

        $message = [];
        if ($performanceTypeCount['COUNT(*)'] == 0){
            $message[] = "Add at least 1 performance type";
        }

        return $message;
    }
}
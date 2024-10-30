<?php

namespace app\repository\implementation;

use app\dto\request\ArtistDetailsRequest;
use app\models\ArtistDetails;
use app\repository\ArtistDetailsRepositoryInterface;
use config\Database;
use Exception;

class ArtistDetailsRepository implements ArtistDetailsRepositoryInterface
{
    protected Database $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    /**
     * @throws Exception
     */
    public function saveUserProfile(ArtistDetailsRequest $userProfileRequest): ArtistDetails
    {
        try {
            $existingUserDetails = $this->getUserProfile($userProfileRequest->getUserId());

            if ($existingUserDetails == null) {
                $this->insertUserProfile($userProfileRequest);
            } else {
                $this->updateUserProfile($userProfileRequest);
            }
            return $this->getUserProfile($userProfileRequest->getUserId());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    private function insertUserProfile(ArtistDetailsRequest $userProfileRequest): void
    {
        $query = "INSERT INTO artist_details (user_id, full_name, stage_name, phone, address, category_id, bio, description, profile_picture) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->executeQuery($query, $userProfileRequest);
    }

    private function updateUserProfile(ArtistDetailsRequest $userProfileRequest): void
    {
        $query = "UPDATE artist_details 
                  SET full_name=?, stage_name=?, phone=?, address=?, category_id=?, bio=?, description=?
                  WHERE user_id = ?";
        $this->executeQuery($query, $userProfileRequest);
    }

    private function executeQuery($query, ArtistDetailsRequest $userProfileRequest): void
    {
        $statement = $this->database->getConnection()->prepare($query);
        if (!$statement) {
            $_SESSION['errors'][] = "Error preparing statement: " . $this->database->getConnection()->error;
            return;
        }

        $fullName = $userProfileRequest->getFullName();
        $stageName = $userProfileRequest->getStageName();
        $phone = $userProfileRequest->getPhone();
        $address = $userProfileRequest->getAddress();
        $categoryID = $userProfileRequest->getCategoryID();
        $bio = $userProfileRequest->getBio();
        $description = $userProfileRequest->getDescription();
        $userId = $userProfileRequest->getUserId();
        $profilePicture = "uploads/profile_pictures/default-profile.png";

        $isInsert = str_contains($query, 'INSERT');
        $params = $isInsert
            ? ["issssssss", $userId, $fullName, $stageName, $phone, $address, $categoryID, $bio, $description, $profilePicture]
            : ["sssssssi", $fullName, $stageName, $phone, $address, $categoryID, $bio, $description, $userId];

        $statement->bind_param(...$params);

        if (!$statement->execute()) {
            $_SESSION['errors'][] = "Error executing statement: " . $statement->error;
            return;
        }

        $statement->close();
    }

    /**
     * @throws Exception
     */
    public function getUserProfile(string $userId): ?ArtistDetails
    {
        $query = "SELECT * FROM artist_details WHERE user_id = ?";
        $statement = $this->database->getConnection()->prepare($query);
        $statement->bind_param("i", $userId);
        $statement->execute();
        $result = $statement->get_result();
        if ($result->num_rows === 0) {
            return null;
        }
        $profile = $result->fetch_assoc();

        $userDetails = new ArtistDetails(
            $profile['id'],
            $profile['full_name'] ?? null,
            $profile['stage_name'] ?? null,
            $profile['phone'] ?? null,
            $profile['address'] ?? null,
            $profile['category_id'] ?? null,
            $profile['bio'] ?? null,
            $profile['profile_picture'] ?? null,
            $profile['description'] ?? null
        );

        $statement->close();

        return $userDetails;
    }

    /**
     * @throws Exception
     */
    public function saveProfilePicture(string $profilePicture, string $userId): ?ArtistDetails
    {
        $query = "UPDATE artist_details
                  SET profile_picture=?
                  WHERE user_id = ?";
        $this->prepareAndExecuteStatement($query, $profilePicture, $userId);
        return $this->getUserProfile($userId);
    }

    /**
     * @throws Exception
     */
    private function prepareAndExecuteStatement(string $query, ...$params): void
    {
        $statement = $this->database->getConnection()->prepare($query);
        if (!$statement) {
            throw new Exception("Error preparing statement: " . $this->database->getConnection()->error);
        }

        $statement->bind_param("si", ...$params);

        if (!$statement->execute()) {
            throw new Exception("Error executing statement: " . $statement->error);
        }

    }

    public function getAllArtistsByCategory($id): array
    {
        $query = "SELECT * FROM artist_details where category_id = ?";
        $stmt = $this->database->getConnection()->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $artists = [];
        while ($row = $result->fetch_assoc()) {
            $artist = [
                'id' => $row['id'],
                'userId' => $row['user_id'],
                'full_name' => $row['full_name'],
                'stage_name' => $row['stage_name'],
                'phone' => $row['phone'],
                'address' => $row['address'],
                'category_id' => $row['category_id'],
                'bio' => $row['bio'],
                'profile_picture' => $row['profile_picture'],
                'description' => $row['description']
            ];


            $artist['rating'] = $this->getArtistRating($artist['userId']);

            // Query to get the social media links
            $socialMediaQuery = "SELECT asm.*, smp.platform_name as platform_name, smp.icon_class as platform_icon 
                             FROM artistsocialmedia asm 
                             INNER JOIN socialmediaplatforms smp ON asm.platform_id = smp.platform_id 
                             WHERE asm.artist_id = ?";
            $socialMediaStmt = $this->database->getConnection()->prepare($socialMediaQuery);
            $socialMediaStmt->bind_param("i", $artist['id']);
            $socialMediaStmt->execute();
            $socialMediaResult = $socialMediaStmt->get_result();
            $socialMediaLinks = [];
            while ($socialMediaRow = $socialMediaResult->fetch_assoc()) {
                $socialMediaLinks[] = $socialMediaRow;
            }
            $artist['social_media_links'] = $socialMediaLinks;
            $artists[] = $artist;
        }
        return $artists;

    }

    public function getAllArtists(): array
    {
        $query = "SELECT * FROM artist_details";
        $result = $this->database->getConnection()->query($query);
        $singers = [];
        while ($row = $result->fetch_assoc()) {
            $singers[] = new ArtistDetails(
                $row['id'],
                $row['full_name'],
                $row['stage_name'],
                $row['phone'],
                $row['address'],
                $row['category_id'],
                $row['bio'],
                $row['profile_picture'],
                $row['description']
            );
        }
        return $singers;
    }

    public function getArtistById($id): ?array
    {
        // Query to get the artist by id
        $query = "SELECT * FROM artist_details WHERE id = ?";
        $stmt = $this->database->getConnection()->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            return null;
        }

        $artist = [
            'id' => $row['id'],
            'userId' => $row['user_id'],
            'full_name' => $row['full_name'],
            'stage_name' => $row['stage_name'],
            'phone' => $row['phone'],
            'address' => $row['address'],
            'category_id' => $row['category_id'],
            'bio' => $row['bio'],
            'profile_picture' => $row['profile_picture'],
            'description' => $row['description']
        ];

        $artist['rating'] = $this->getArtistRating($artist['userId']);

        // Query to get the social media links
        $socialMediaQuery = "SELECT DISTINCT asm.*, smp.platform_name as platform_name, smp.icon_class as platform_icon
                         FROM artistsocialmedia asm
                         INNER JOIN socialmediaplatforms smp ON asm.platform_id = smp.platform_id
                         WHERE asm.artist_id = ?";
        $socialMediaStmt = $this->database->getConnection()->prepare($socialMediaQuery);
        $socialMediaStmt->bind_param("i", $artist['userId']);
        $socialMediaStmt->execute();
        $socialMediaResult = $socialMediaStmt->get_result();
        $socialMediaLinks = [];
        while ($socialMediaRow = $socialMediaResult->fetch_assoc()) {
            $socialMediaLinks[] = $socialMediaRow;
        }
        $artist['social_media_links'] = $socialMediaLinks;

        return $artist;
    }

    public function getArtistRating($id)
    {
        $query = "SELECT AVG(rating) as rating FROM comments WHERE artist_id = ?";
        $stmt = $this->database->getConnection()->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rating = $result->fetch_assoc();
        return $rating['rating'] ?? 0.0;
    }

    /**
     * @throws Exception
     */
    function getArtistIdByArtistDetailsId($artistDetailsId)
    {
        $query = "SELECT user_id FROM artist_details WHERE id = ?";
        $stmt = $this->database->getConnection()->prepare($query);
        $stmt->bind_param("i", $artistDetailsId);
        $stmt->execute();
        $result = $stmt->get_result();
        $artistId = $result->fetch_assoc()['user_id'];
        if ($artistId === null) {
            throw new Exception('Invalid artist details ID');
        }
        return $artistId;

    }

    public function getAllArtistsForHomepage($page, $limit): array
    {
        // Calculate the offset for the database query
        $offset = ($page - 1) * $limit;

        // Query to get the artists for the current page
        $query = "SELECT * FROM artist_details LIMIT ?, ?";
        $stmt = $this->database->getConnection()->prepare($query);
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        // Build the artists array
        $artists = [];
        while ($row = $result->fetch_assoc()) {
            $artist = [
                'id' => $row['id'],
                'full_name' => $row['full_name'],
                'stage_name' => $row['stage_name'],
                'profile_picture' => $row['profile_picture'],
                'rating' => $this->getArtistRating($row['user_id']),
                'description' => $row['description'],
                'social_media_links' => $this->getSocialMediaLinks($row['user_id'])
            ];
            $artists[] = $artist;
        }

        // Query to get the total number of artists
        $totalItemsQuery = "SELECT COUNT(*) as total_items FROM artist_details";
        $totalItemsResult = $this->database->getConnection()->query($totalItemsQuery);
        $totalItems = $totalItemsResult->fetch_assoc()['total_items'];

        // Calculate the total number of pages
        $totalPages = ceil($totalItems / $limit);

        return [
            'success' => true,
            'data' => $artists,
            'message' => 'Artists fetched successfully',
            'pagination' => [
                'total_items' => $totalItems,
                'current_page' => $page,
                'items_per_page' => $limit,
                'total_pages' => $totalPages
            ]
        ];
    }
    private function getSocialMediaLinks($userId): array
    {
        // Query to get the social media links
        $socialMediaQuery = "SELECT DISTINCT asm.*, smp.platform_name as platform, smp.icon_class as platform_icon
                         FROM artistsocialmedia asm
                         INNER JOIN socialmediaplatforms smp ON asm.platform_id = smp.platform_id
                         WHERE asm.artist_id = ?";
        $socialMediaStmt = $this->database->getConnection()->prepare($socialMediaQuery);
        $socialMediaStmt->bind_param("i", $userId);
        $socialMediaStmt->execute();
        $socialMediaResult = $socialMediaStmt->get_result();
        $socialMediaLinks = [];
        while ($socialMediaRow = $socialMediaResult->fetch_assoc()) {
            $socialMediaLinks[] = [
                'platform' => $socialMediaRow['platform'],
                'url' => $socialMediaRow['url'],
                'platform_icon' => $socialMediaRow['platform_icon']
            ];
        }
        return $socialMediaLinks;
    }
}
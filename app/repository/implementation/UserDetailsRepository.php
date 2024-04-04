<?php

namespace App\repository\implementation;

use App\models\SocialMediaLink;
use App\models\UserDetails;
use App\repository\UserDetailsRepositoryInterface;
use config\Database;
use Exception;

class UserDetailsRepository implements UserDetailsRepositoryInterface
{
    protected Database $database;

    public function __construct() {
        $this->database = new Database;
    }

    /**
     * @throws Exception
     */
    public function getUserDetails(int $id): UserDetails
    {
        try {
            $sql = "SELECT * FROM userDetails WHERE id = ?";
            $stmt = $this->database->getConnection()->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            if ($result === null) {
                throw new Exception('No user details found for the provided ID.');
            }

            // Fetch social media links
            $sql = "SELECT * FROM SocialMediaLinks WHERE user_id = ?";
            $stmt = $this->database->getConnection()->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $socialMediaLinks = [];
            $resultSocialMedia = $stmt->get_result();
            while ($row = $resultSocialMedia->fetch_assoc()) {
                $socialMediaLinks[] = new SocialMediaLink(
                    $row['id'],
                    $row['user_id'],
                    $row['name'],
                    $row['link']
                );
            }

            return new UserDetails(
                $result['id'],
                $result['fullName'],
                $result['phone'],
                $result['address'],
                $result['profilePicture'],
                $socialMediaLinks,
                $result['bio'],
                $result['created_at'],
                $result['updated_at']
            );
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function createUserDetails(UserDetails $userDetails): UserDetails
    {
        try {
            // Start a new transaction
            $this->database->getConnection()->autocommit(false);

            // Insert user details into the userDetails table
            $sql = "INSERT INTO userDetails (fullName, phone, address, profilePicture, bio) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->database->getConnection()->prepare($sql);
            $fullName = $userDetails->getFullName();
            $phone = $userDetails->getPhone();
            $address = $userDetails->getAddress();
            $profilePicture = $userDetails->getProfilePicture();
            $bio = $userDetails->getBio();
            $stmt->bind_param("sssss", $fullName, $phone, $address, $profilePicture, $bio);
            $stmt->execute();

            // Fetch the ID of the inserted user details
            $userDetailsId = $stmt->insert_id;

            // Insert social media links into the SocialMediaLinks table
            $socialMediaLinks = $userDetails->getSocialMedia();
            if ($socialMediaLinks !== null) {
                foreach ($socialMediaLinks as $socialMediaLink) {
                    $sql = "INSERT INTO SocialMediaLinks (user_id, name, link) VALUES (?, ?, ?)";
                    $stmt = $this->database->getConnection()->prepare($sql);
                    $name = $socialMediaLink->getName();
                    $link = $socialMediaLink->getLink();
                    $stmt->bind_param("iss", $userDetailsId, $name, $link);
                    $stmt->execute();
                }
            }

            // Commit the transaction
            $this->database->getConnection()->commit();

            // Return the created UserDetails object
            return new UserDetails(
                $userDetailsId,
                $fullName,
                $phone,
                $address,
                $profilePicture,
                $userDetails->getSocialMedia(),
                $bio,
                date('Y-m-d H:i:s'),  // Current date and time as created_at
                date('Y-m-d H:i:s')   // Current date and time as updated_at
            );
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            $this->database->getConnection()->rollback();
            throw new Exception($e->getMessage());
        }
    }}
<?php

namespace app\dto\response;


use app\models\ArtistDetails;

class ArtistDetailsResponse {
    private array $data;

    public function __construct(ArtistDetails $userDetails) {
        $this->data = [
            'id' => $userDetails->getId() ?? 0,
            'fullName' => $userDetails->getFullName() ?? '',
            'stageName' => $userDetails->getStageName() ?? '',
            'phone' => $userDetails->getPhone() ?? '',
            'address' => $userDetails->getAddress() ?? '',
            'category' => $userDetails->getCategory() ?? '',
            'bio' => $userDetails->getBio() ?? '',
            'profilePicture' => $userDetails->getProfilePicture() ?? '',
            'description' => $userDetails->getDescription() ?? ''
        ];
    }

    public function getData(): array {
        return $this->data;
    }
}

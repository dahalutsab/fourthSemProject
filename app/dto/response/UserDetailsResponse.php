<?php

namespace App\dto\response;

use App\models\UserDetails;

class UserDetailsResponse
{
    private int $id;
    private ?string $fullName;
    private ?string $phone;
    private ?string $address;
    private ?string $profilePicture;
    private ?array $socialMedia;
    private ?string $bio;

    public function __construct(UserDetails $userDetails) {
        $this->id = $userDetails->getId() ?? 0;
        $this->fullName = $userDetails->getFullName() ?? '';
        $this->phone = $userDetails->getPhone() ?? '';
        $this->address = $userDetails->getAddress() ?? '';
        $this->profilePicture = $userDetails->getProfilePicture() ?? '';
        $this->socialMedia = $userDetails->getSocialMedia() ?? [];
        $this->bio = $userDetails->getBio() ?? '';
    }

    public function getData(): array {
        $socialMedia = [];
        foreach ($this->socialMedia as $socialMediaLink) {
            $socialMedia[] = [
                'name' => $socialMediaLink->getName(),
                'link' => $socialMediaLink->getLink()
            ];
        }

        return [
            'id' => $this->id,
            'fullName' => $this->fullName,
            'phone' => $this->phone,
            'address' => $this->address,
            'profilePicture' => $this->profilePicture,
            'socialMedia' => $socialMedia,
            'bio' => $this->bio
        ];
    }
}
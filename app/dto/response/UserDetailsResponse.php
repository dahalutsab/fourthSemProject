<?php

namespace App\dto\response;


use App\models\UserDetails;

class UserDetailsResponse {
    private array $data;

    public function __construct(UserDetails $userDetails) {
        $this->data = [
            'id' => $userDetails->getId() ?? 0,
            'stageName' => $userDetails->getStageName() ?? '',
            'phone' => $userDetails->getPhone() ?? '',
            'address' => $userDetails->getAddress() ?? '',
            'category' => $userDetails->getCategory() ?? '',
            'bio' => $userDetails->getBio() ?? '',
            'description' => $userDetails->getDescription() ?? ''
        ];
    }

    public function getData(): array {
        return $this->data;
    }
}

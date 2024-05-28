<?php
namespace app\models;
use DateTimeImmutable;

class ArtistDetails {
    private int $id;
    private ?string $fullName;
    private ?string $stageName;
    private ?string $phone;
    private ?string $address;
    private ?string $category;
    private ?string $bio;
    private ?string $description;
    private ?string $profilePicture;
    private ?array $socialMedia;
    private DateTimeImmutable $updated_at;

    public function __construct(
        int $id,
        ?string $fullName,
        ?string $stageName,
        ?string $phone,
        ?string $address,
        ?string $category,
        ?string $bio,
        ?string $profilePicture,
        ?string $description,
        ?array $socialMedia = []
    ) {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->stageName = $stageName;
        $this->phone = $phone;
        $this->address = $address;
        $this->category = $category;
        $this->bio = $bio;
        $this->profilePicture = $profilePicture;
        $this->description = $description;
        $this->socialMedia = $socialMedia;
    }


    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getFullName(): ?string {
        return $this->fullName;
    }

    public function setFullName(string $fullName): void {
        $this->fullName = $fullName;
    }

    public function getStageName(): ?string {
        return $this->stageName;
    }

    public function setStageName(string $stageName): void {
        $this->stageName = $stageName;
    }

    public function getPhone(): ?string {
        return $this->phone;
    }

    public function setPhone(string $phone): void {
        $this->phone = $phone;
    }

    public function getAddress(): ?string {
        return $this->address;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }

    public function getCategory(): ?string {
        return $this->category;
    }

    public function setCategory(string $category): void {
        $this->category = $category;
    }

    public function getBio(): ?string {
        return $this->bio;
    }

    public function setBio(string $bio): void {
        $this->bio = $bio;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getProfilePicture(): ?string {
        return $this->profilePicture;
    }
    public function setProfilePicture(string $profilePicture): void {
        $this->profilePicture = $profilePicture;
    }

    public function getSocialMedia(): ?array {
        return $this->socialMedia;
    }

    public function setSocialMedia(array $socialMedia): void {
        $this->socialMedia = $socialMedia;
    }

    public function setUpdatedAt(): void {
        $this->updated_at = new DateTimeImmutable();
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function getData(): array
    {
        return [
            'id' => $this->id,
            'fullName' => $this->fullName,
            'stageName' => $this->stageName,
            'phone' => $this->phone,
            'address' => $this->address,
            'category' => $this->category,
            'bio' => $this->bio,
            'profilePicture' => $this->profilePicture,
            'description' => $this->description,
            'socialMedia' => $this->socialMedia,
            'updated_at' => $this->updated_at
        ];
    }

}

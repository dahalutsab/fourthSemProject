<?php
class UserDetails {
    private string $fullName;
    private string $stageName;
    private string $phone;
    private string $address;
    private string $talentType;
    private string $bio;
    private string $description;
    private string $profilePicture;
    private array $socialMedia;
    private DateTimeImmutable $updated_at;

    public function __construct(
        string $fullName,
        string $stageName,
        string $phone,
        string $address,
        string $talentType,
        string $bio,
        string $description,
        array $socialMedia = []
    ) {
        $this->fullName = $fullName;
        $this->stageName = $stageName;
        $this->phone = $phone;
        $this->address = $address;
        $this->talentType = $talentType;
        $this->bio = $bio;
        $this->description = $description;
        $this->socialMedia = $socialMedia;

    }

    public function getFullName(): string {
        return $this->fullName;
    }

    public function setFullName(string $fullName): void {
        $this->fullName = $fullName;
    }

    public function getStageName(): string {
        return $this->stageName;
    }

    public function setStageName(string $stageName): void {
        $this->stageName = $stageName;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function setPhone(string $phone): void {
        $this->phone = $phone;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }

    public function getTalentType(): string {
        return $this->talentType;
    }

    public function setTalentType(string $talentType): void {
        $this->talentType = $talentType;
    }

    public function getBio(): string {
        return $this->bio;
    }

    public function setBio(string $bio): void {
        $this->bio = $bio;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getProfilePicture(): string {
        return $this->profilePicture;
    }
    public function setProfilePicture(string $profilePicture): void {
        $this->profilePicture = $profilePicture;
    }

    public function getSocialMedia(): array {
        return $this->socialMedia;
    }

    public function setSocialMedia(array $socialMedia): void {
        $this->socialMedia = $socialMedia;
    }

    public function setUpdatedAt(): void {
        $this->updated_at = new DateTimeImmutable();
    }
    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updated_at;
    }
}

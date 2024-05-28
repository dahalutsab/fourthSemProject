<?php

namespace app\models;

class SocialMediaLink
{
    private ?int $id;
    private int $user_id;
    private string $name;
    private string $link;

    public function __construct(?int $id, int $user_id, string $name, string $link)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->link = $link;
    }

    // Add getters and setters here...
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }
}
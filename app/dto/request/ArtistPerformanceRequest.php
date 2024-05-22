<?php

namespace App\dto\request;

class ArtistPerformanceRequest
{

    private int $artist_id;
    private int $performance_type_id;
    private float $duration_hours;
    private string $date;
    private string $event_name;
    private int $user_id;
    private LocationRequest $locationRequest;

    public function __construct($artist_id, $performance_type_id, $duration_hours, $date, $event_name, $user_id, $locationRequest)
    {
        $this->artist_id = $artist_id;
        $this->performance_type_id = $performance_type_id;
        $this->duration_hours = $duration_hours;
        $this->date = $date;
        $this->event_name = $event_name;
        $this->user_id = $user_id;
        $this->locationRequest = $locationRequest;
    }

    public function getArtistId(): int
    {
        return $this->artist_id;
    }

    public function setArtistId($artist_id): void
    {
        $this->artist_id = $artist_id;
    }

    public function getPerformanceTypeId(): int
    {
        return $this->performance_type_id;
    }

    public function setPerformanceTypeId($performance_type_id): void
    {
        $this->performance_type_id = $performance_type_id;
    }

    public function getDurationHours(): float
    {
        return $this->duration_hours;
    }


    public function setDurationHours($duration_hours): void
    {
        $this->duration_hours = $duration_hours;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getEventName(): string
    {
        return $this->event_name;
    }

    public function setEventName($event_name): void
    {
        $this->event_name = $event_name;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getLocationRequest(): LocationRequest
    {
        return $this->locationRequest;
    }

    public function setLocationRequest($locationRequest): void
    {
        $this->locationRequest = $locationRequest;
    }

}
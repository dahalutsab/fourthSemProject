<?php

namespace App\models;

class ArtistPerformance
{
private int $artist_performance_id;
private int $artist_id;
private int $performance_type_id;
private float $duration_hours;
private string $date;
private string $event_name;
private int $user_id;

private int $location_id;

public function __construct($artist_performance_id, $artist_id, $performance_type_id, $duration_hours, $date, $event_name, $user_id, $location_id)
{
    $this->artist_performance_id = $artist_performance_id;
    $this->artist_id = $artist_id;
    $this->performance_type_id = $performance_type_id;
    $this->duration_hours = $duration_hours;
    $this->date = $date;
    $this->event_name = $event_name;
    $this->user_id = $user_id;
    $this->location_id = $location_id;
}

public function getArtistPerformanceId(): int
{
    return $this->artist_performance_id;
}

public function setArtistPerformanceId($artist_performance_id): void
{
    $this->artist_performance_id = $artist_performance_id;
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

public function getLocationId(): int
{
    return $this->location_id;
}

public function setLocationId($location_id): void
{
    $this->location_id = $location_id;
}
}

<?php

namespace App\dto\request;

class PerformanceTypeRequest
{
    private string $performance_type;
    private int|string $artist_id;
    private float $cost_per_hour;


    public function __construct(string $performance_type, int|string $artist_id, int $cost_per_hour)
    {
        $this->performance_type = $performance_type;
        $this->artist_id = $artist_id;
        $this->cost_per_hour = $cost_per_hour;
    }

    public function getPerformanceType(): string
    {
        return $this->performance_type;
    }

    public function setPerformanceType(string $performance_type): void
    {
        $this->performance_type = $performance_type;
    }

    public function getArtistId(): int|string
    {
        return $this->artist_id;
    }

    public function setArtistId(int $artist_id): void
    {
        $this->artist_id = $artist_id;
    }

    public function getCostPerHour(): float
    {
        return $this->cost_per_hour;
    }

    public function setCostPerHour(float $cost_per_hour): void
    {
        $this->cost_per_hour = $cost_per_hour;
    }


}
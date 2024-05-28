<?php

namespace app\dto\response;

class PerformanceTypesResponse
{
    private int $performance_type_id;
    private string $performance_type;
    private int $artist_id;
    private float $cost_per_hour;

    private bool $is_deleted;

    public function __construct(int $performance_type_id, string $performance_type, int $artist_id, float $cost_per_hour, bool $is_deleted = false)
    {
        $this->performance_type_id = $performance_type_id;
        $this->performance_type = $performance_type;
        $this->artist_id = $artist_id;
        $this->cost_per_hour = $cost_per_hour;
        $this->is_deleted = $is_deleted;
    }

    public function getPerformanceTypeId(): int
    {
        return $this->performance_type_id;
    }

    public function setPerformanceTypeId(int $performance_type_id): void
    {
        $this->performance_type_id = $performance_type_id;
    }

    public function getPerformanceType(): string
    {
        return $this->performance_type;
    }

    public function setPerformanceType(string $performance_type): void
    {
        $this->performance_type = $performance_type;
    }

    public function getArtistId(): int
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

    public function isDeleted(): bool
    {
        return $this->is_deleted;
    }

    public function setDeleted(bool $is_deleted): void
    {
        $this->is_deleted = $is_deleted;
    }

//    array
    public function toArray(): array
    {
        return [
            'performance_type_id' => $this->performance_type_id,
            'performance_type' => $this->performance_type,
            'artist_id' => $this->artist_id,
            'cost_per_hour' => $this->cost_per_hour,
            'is_deleted' => $this->is_deleted
        ];
    }
}
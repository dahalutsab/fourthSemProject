<?php

namespace app\models;

namespace app\models;


// Booking.php
class Booking
{
    private int $id;
    private int $userId;
    private int $artistId;
    private int $provinceId;
    private int $districtId;
    private int $municipalityId;
    private string $localArea;
    private string $eventDate;
    private string $eventStartTime;
    private string $eventEndTime;
    private string $totalCost;
    private string $advanceAmount;
    private string $remainingAmount;
    private int $performanceTypeId;
    private string $status;

    public function __construct(array $data)
    {
        $this->provinceId = $data['province_id'];
        $this->userId = $data['user_id'];
        $this->artistId = $data['artist_id'];
        $this->districtId = $data['district_id'];
        $this->municipalityId = $data['municipality_id'];
        $this->localArea = $data['local_area'];
        $this->eventDate = $data['event_date'];
        $this->eventStartTime = $data['event_start_time'];
        $this->eventEndTime = $data['event_end_time'];
        $this->totalCost = $data['total_cost'];
        $this->advanceAmount = $data['advance_amount'];
        $this->remainingAmount = $data['remaining_amount'];
        $this->performanceTypeId = $data['performance_type_id'];
        $this->status = $data['status'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getArtistId(): int
    {
        return $this->artistId;
    }


    public function getProvinceId(): int
    {
        return $this->provinceId;
    }

    public function getDistrictId(): int
    {
        return $this->districtId;
    }

    public function getMunicipalityId(): int
    {
        return $this->municipalityId;
    }

    public function getLocalArea(): string
    {
        return $this->localArea;
    }

    public function getEventDate(): string
    {
        return $this->eventDate;
    }

    public function getEventStartTime(): string
    {
        return $this->eventStartTime;
    }

    public function getEventEndTime(): string
    {
        return $this->eventEndTime;
    }

    public function getTotalCost(): string
    {
        return $this->totalCost;
    }

    public function getAdvanceAmount(): string
    {
        return $this->advanceAmount;
    }

    public function getRemainingAmount(): string
    {
        return $this->remainingAmount;
    }

    public function getPerformanceTypeId(): int
    {
        return $this->performanceTypeId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}


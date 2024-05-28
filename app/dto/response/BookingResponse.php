<?php

namespace app\dto\response;

use app\models\Booking;

class BookingResponse
{
    private int $bookingId;
    private int $provinceId;
    private int $userId;
    private int $artistId;
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

    public function __construct(Booking $booking)
    {
        $this->bookingId = $booking->getId();
        $this->provinceId = $booking->getProvinceId();
        $this->userId = $booking->getUserId();
        $this->artistId = $booking->getArtistId();
        $this->districtId = $booking->getDistrictId();
        $this->municipalityId = $booking->getMunicipalityId();
        $this->localArea = $booking->getLocalArea();
        $this->eventDate = $booking->getEventDate();
        $this->eventStartTime = $booking->getEventStartTime();
        $this->eventEndTime = $booking->getEventEndTime();
        $this->totalCost = $booking->getTotalCost();
        $this->advanceAmount = $booking->getAdvanceAmount();
        $this->remainingAmount = $booking->getRemainingAmount();
        $this->performanceTypeId = $booking->getPerformanceTypeId();
        $this->status = $booking->getStatus();
    }

//    return as array
    public function toArray(): array
    {
        return [
            'bookingId' => $this->bookingId,
            'province_id' => $this->provinceId,
            'user_id' => $this->userId,
            'artist_id' => $this->artistId,
            'district_id' => $this->districtId,
            'municipality_id' => $this->municipalityId,
            'local_area' => $this->localArea,
            'event_date' => $this->eventDate,
            'event_start_time' => $this->eventStartTime,
            'event_end_time' => $this->eventEndTime,
            'total_cost' => $this->totalCost,
            'advance_amount' => $this->advanceAmount,
            'remaining_amount' => $this->remainingAmount,
            'performance_type_id' => $this->performanceTypeId,
            'status' => $this->status
        ];
    }


}
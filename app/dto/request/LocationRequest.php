<?php

namespace app\dto\request;

class LocationRequest
{
    private int $municipality_id;

    private string $location_name;

    public function __construct($municipality_id, $location_name)
    {
        $this->municipality_id = $municipality_id;
        $this->location_name = $location_name;
    }

    public function getMunicipalityId(): int
    {
        return $this->municipality_id;
    }

    public function setMunicipalityId($municipality_id): void
    {
        $this->municipality_id = $municipality_id;
    }

    public function getLocationName(): string
    {
        return $this->location_name;
    }

    public function setLocationName($location_name): void
    {
        $this->location_name = $location_name;
    }

}
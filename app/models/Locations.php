<?php

namespace app\models;

class Locations
{

private int $location_id;

private int $municipality_id;

private string $location_name;

public function __construct($location_id, $municipality_id, $location_name)
{
    $this->location_id = $location_id;
    $this->municipality_id = $municipality_id;
    $this->location_name = $location_name;
}

public function getLocationId(): int
{
    return $this->location_id;
}

public function setLocationId($location_id): void
{
    $this->location_id = $location_id;
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


<?php

namespace app\models;

class Municipality
{
    private int $municipality_id;

    private string $municipality_name;

    private int $district_id;

    public function __construct($municipality_id, $municipality_name, $district_id)
    {
        $this->municipality_id = $municipality_id;
        $this->municipality_name = $municipality_name;
        $this->district_id = $district_id;
    }

    public function getMunicipalityId(): int
    {
        return $this->municipality_id;
    }

    public function setMunicipalityId($municipality_id): void
    {
        $this->municipality_id = $municipality_id;
    }

    public function getMunicipalityName(): string
    {
        return $this->municipality_name;
    }

    public function setMunicipalityName($municipality_name): void
    {
        $this->municipality_name = $municipality_name;
    }

    public function getDistrictId(): int
    {
        return $this->district_id;
    }

    public function setDistrictId($district_id): void
    {
        $this->district_id = $district_id;
    }


}
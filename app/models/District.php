<?php

namespace app\models;

class District
{
    private int $district_id;

    private string $district_name;

    private int $province_id;

    public function __construct($district_id, $district_name, $province_id)
    {
        $this->district_id = $district_id;
        $this->district_name = $district_name;
        $this->province_id = $province_id;
    }

    public function getDistrictId(): int
    {
        return $this->district_id;
    }

    public function setDistrictId($district_id): void
    {
        $this->district_id = $district_id;
    }

    public function getDistrictName(): string
    {
        return $this->district_name;
    }

    public function setDistrictName($district_name): void
    {
        $this->district_name = $district_name;
    }

    public function getProvinceId(): int
    {
        return $this->province_id;
    }

    public function setProvinceId($province_id): void
    {
        $this->province_id = $province_id;
    }
}
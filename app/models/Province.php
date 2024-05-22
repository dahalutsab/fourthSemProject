<?php

namespace app\models;

class Province
{
    private int $province_id;

    private string $province_name;

    public function __construct($province_id, $province_name)
    {
        $this->province_id = $province_id;
        $this->province_name = $province_name;
    }

    public function getProvinceId(): int
    {
        return $this->province_id;
    }

    public function setProvinceId($province_id): void
    {
        $this->province_id = $province_id;
    }

    public function getProvinceName(): string
    {
        return $this->province_name;
    }

    public function setProvinceName($province_name): void
    {
        $this->province_name = $province_name;
    }

}
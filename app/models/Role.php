<?php

namespace App\models;

class Role
{
    private int $role_id;
    private string $roleName;

    public function __construct(int $role_id, string $roleName)
    {
        $this->role_id = $role_id;
        $this->roleName = $roleName;
    }

    public function getRoleId(): int
    {
        return $this->role_id;
    }
    public function getRoleName(): string
    {
        return $this->roleName;
    }
}
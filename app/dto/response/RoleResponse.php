<?php

namespace App\dto\response;

namespace App\dto\response;

use App\models\Role;

class RoleResponse
{
    public int $role_id;
    public string $roleName;

    public function __construct(Role $role)
    {
        $this->role_id = $role->getRoleId();
        $this->roleName = $role->getRoleName();
    }

}
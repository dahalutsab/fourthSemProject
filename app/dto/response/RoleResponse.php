<?php

namespace app\dto\response;

namespace app\dto\response;

use app\models\Role;

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
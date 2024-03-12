<?php

namespace App\Controllers;
use App\Services\Implementation\RoleService;

require_once __DIR__ . '/../../app/service/implementation/RoleService.php';

class RoleController
{

    protected RoleService $userService;

    public function __construct() {
        $this->userService = new RoleService;
    }



    public function getRolesForUsers(): array
    {
        return $this->userService->getRolesForUsers();
    }
}
<?php

namespace App\controllers;
use App\service\implementation\RoleService;


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
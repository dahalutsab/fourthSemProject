<?php

namespace app\controllers;
use app\response\APIResponse;
use app\service\implementation\RoleService;
use app\service\RoleServiceInterface;


class RoleController
{

    protected RoleServiceInterface $userService;

    public function __construct() {
        $this->userService = new RoleService;
    }



    public function getRolesForUsers()
    {
        $roles = $this->userService->getRolesForUsers();
        return APIResponse::success($roles,'Roles fetched successfully');
    }


}
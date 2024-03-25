<?php

namespace App\controllers;
use App\Response\ApiResponse;
use App\service\implementation\RoleService;
use App\service\RoleServiceInterface;


class RoleController
{

    protected RoleServiceInterface $userService;

    public function __construct() {
        $this->userService = new RoleService;
    }



    public function getRolesForUsers()
    {
        $roles = $this->userService->getRolesForUsers();
        return ApiResponse::success($roles,'Roles fetched successfully');
    }


}
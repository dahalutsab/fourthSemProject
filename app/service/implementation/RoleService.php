<?php

namespace app\service\implementation;

use app\dto\response\RoleResponse;
use app\repository\implementation\RoleRepository;
use app\service\RoleServiceInterface;


class RoleService implements RoleServiceInterface
{
    protected RoleRepository $roleRepository;

    public function __construct()
    {
        $this->roleRepository = new RoleRepository;
    }

    public function getRolesForUsers(): array
    {
        $roles = $this->roleRepository->getRolesForUser();
        return array_map(function ($role) {
            return new RoleResponse($role);
        }, $roles);
    }

    public function validateRole($role): bool
    {
        return $this->roleRepository->getExistsRoleByID($role);
    }
}
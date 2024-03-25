<?php

namespace App\service\implementation;

use App\dto\response\RoleResponse;
use App\repository\implementation\RoleRepository;
use App\Service\RoleServiceInterface;


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
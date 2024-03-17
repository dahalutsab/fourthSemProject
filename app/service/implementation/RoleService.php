<?php

namespace App\service\implementation;

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
        return $this->roleRepository->getRolesForUser();
    }

    public function validateRole($role): bool
    {
        return $this->roleRepository->getExistsRoleByID($role);
    }
}
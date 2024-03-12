<?php

namespace App\Services\Implementation;

use App\Repository\RoleRepository;
use App\Service\RoleServiceInterface;

require_once __DIR__ . '/../../repository/implementation/RoleRepository.php';

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
}
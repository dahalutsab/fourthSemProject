<?php

namespace App\Repository;

interface RoleRepositoryInterface
{
    public function saveRole($roleName);
    public function getRole($roleName);
    public function getRoleById($id);
    public function getRoles();
    public function updateRole($id, $roleName);
    public function deleteRole($id);
}
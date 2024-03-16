<?php

namespace App\Repository;

use App\models\Role;
use Config\Database;

class RoleRepository implements RoleRepositoryInterface
{
    protected string $ADMIN = 'ADMIN';
    protected string $USER = 'USER';
    protected string $ARTIST = 'ARTIST';

    protected Database $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function saveRole($roleName)
    {
        // TODO: Implement saveRole() method.
    }

    public function getRole($roleName)
    {
        // TODO: Implement getRole() method.
    }

    public function getRoleById($id)
    {
        // TODO: Implement getRoles() method.
    }

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getRolesForUser(): array
    {
        $roles = [];
        $result = $this->database->getConnection()->query("SELECT * FROM roles WHERE role_name != '{$this->ADMIN}'");

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $roles[] = new Role($row['role_id'], $row['role_name']);
            }
        }

        return $roles;
    }

    public function updateRole($id, $roleName)
    {
        // TODO: Implement updateRole() method.
    }

    public function deleteRole($id)
    {
        // TODO: Implement deleteRole() method.
    }

    public function getExistsRoleByID($role): bool
    {
        $result = $this->database->getConnection()->query("SELECT * FROM roles WHERE role_id = '{$role}'");

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
<?php

namespace App\Repositories;

use App\Models\Permission;

use App\Interfaces\PermissionInterface;

class PermissionRepository implements PermissionInterface
{
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function getAll()
    {
        return $this->permission->paginate(10);
    }
    public function getAllSelect()
    {
        $permissions = $this->permission->get();

        return $permissions;
    }
}

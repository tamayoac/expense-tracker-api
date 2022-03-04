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
        return $this->permission->get();
    }
    public function getById($permission)
    {
        $permission = $this->permission->findOrFail($permission);
                   
        return $permission;
    }
    public function create(array $attributes)
    {   
        $permission = $this->permission->create([
            'title' => $attributes['title'],
        ]);
        return $permission;
    }
    public function update(array $attributes, $permission)
    {
        $permission = $this->permission->findOrFail($permission);
        
        if(isset($permission)) {
            $permission->update($attributes);

            return $permission;
        }
        return $permission;
    }
    public function delete($permission)
    {
        $permission = $this->permission->findOrFail($permission);
        
        if(isset($permission)) {
            $permission->delete();
            return true;
        }
        return false;
    }
}
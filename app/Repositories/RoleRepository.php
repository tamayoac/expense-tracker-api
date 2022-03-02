<?php

namespace App\Repositories;

use App\Models\Role;

use App\Interfaces\RoleInterface;

class RoleRepository implements RoleInterface
{
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function getAll()
    {
        return $this->role->get();
    }
    public function getById($role)
    {
        $role = $this->role->findOrFail($role);
                   
        return $role;
    }
    public function create(array $attributes)
    {   
        $role = $this->role->create([
            'name' => $attributes['name'],
        ]);
        return $role;
    }
    public function update(array $attributes, $role)
    {
        $role = $this->role->findOrFail($role);
        
        if(isset($role)) {
            $role->update($attributes);

            return $role;
        }
        return $role;
    }
    public function delete($role)
    {
        $role = $this->role->findOrFail($role);
        
        if(isset($role)) {
            $role->delete();
            return true;
        }
        return false;
    }
}
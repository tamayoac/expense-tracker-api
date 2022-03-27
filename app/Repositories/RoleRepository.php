<?php

namespace App\Repositories;

use Carbon\Carbon;

use App\Models\Role;
use App\Helpers\CollectionHelper;
use App\Interfaces\RoleInterface;

class RoleRepository implements RoleInterface
{
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function getAll()
    {

        $roles = $this->role->with('permissions')->paginate(10);

        return $roles;
    }
    public function getAllSelect()
    {

        $roles = $this->role->get();

        return $roles;
    }
    public function getById($role)
    {
        $role = $this->role->findOrFail($role);

        return $role;
    }
    public function create(array $attributes)
    {
        $role = $this->role->create([
            'display_name' => $attributes['display_name'],
            'description' => $attributes['description']
        ]);
        $role->permissions()->attach($attributes['permissions']);
        return $role;
    }
    public function update(array $attributes, $role)
    {
        $role = $this->role->findOrFail($role);

        if (isset($role)) {
            $role->update([
                'display_name' => $attributes['display_name'],
                'description' => $attributes['description']
            ]);
            $role->permissions()->sync($attributes['permissions']);
            return $role;
        }
        return $role;
    }
    public function delete($role)
    {
        $role = $this->role->findOrFail($role);

        if (isset($role)) {
            $role->delete();
            $role->permissions()->detach();
            return true;
        }
        return false;
    }
}

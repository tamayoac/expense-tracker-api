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
        $roleCollection = collect();
        $roles = $this->role->get();
        $page = 10;
        foreach ($roles as $role) {
            $roleCollection->push([
                "id" => $role->id,
                "display_name" => $role->display_name,
                "description" => $role->description,
                "created_at" => Carbon::parse($role->created_at)->format('Y-m-d'),
                "permissions" => $role->permissions()->pluck("id"),
            ]);
        }
        return CollectionHelper::paginate($roleCollection, $page);
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

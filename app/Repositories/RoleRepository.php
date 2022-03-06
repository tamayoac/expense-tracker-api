<?php

namespace App\Repositories;

use App\Models\Role;

use App\Interfaces\RoleInterface;
use Carbon\Carbon;

class RoleRepository implements RoleInterface
{
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function getAll()
    {
        $roleCollection = array();
        $roles = $this->role->get();
        foreach($roles as $role) {
            array_push($roleCollection, array(
                "id" => $role->id,
                "display_name" => $role->display_name,
                "description" => $role->description,
                "created_at" => Carbon::parse($role->created_at)->format('Y-m-d')
            ));
        }
        return $roleCollection;
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
        return $role;
    }
    public function update(array $attributes, $role)
    {
        $role = $this->role->findOrFail($role);
        
        if(isset($role)) {
            $role->update([
                'display_name' => $attributes['display_name'],
                'description' => $attributes['description']
            ]);

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
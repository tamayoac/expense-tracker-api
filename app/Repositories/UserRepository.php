<?php

namespace App\Repositories;

use App\Models\{User, Role};
use Illuminate\Support\Facades\Hash;
use App\Interfaces\UserInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserInterface
{
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    public function getAll($user)
    {
        $users = $this->user->where('id', '!=', $user->id)->with("roles")->get();

        $newUserCollection = array();

        foreach ($users as $user) {
            foreach ($user->roles as $role) {
                array_push($newUserCollection, array(
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email,
                    "role" => [
                        "id" => $role->id,
                        'role' => $role->display_name
                    ],
                    "created_at" => Carbon::parse($user->created_at)->format('Y-m-d')
                ));
            }
        }
        return $newUserCollection;
    }
    public function getById($user)
    {
        $user = $this->user->findOrFail($user);

        return $user;
    }
    public function create(array $attributes)
    {
        try {
            DB::beginTransaction();

            $user = $this->user->create([
                'name' => $attributes['name'],
                'email' => $attributes['email'],
                'password' => Hash::make('password123'),
            ]);



            $role = $this->role->findOrFail($attributes['role']);


            $user->roles()->attach($role->id);
            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollback();
        }
        return null;
    }
    public function update(array $attributes, $user)
    {
        $user = $this->user->findOrFail($user);
        if (isset($user)) {
            $user->update([
                'name' => $attributes['name'],
                'email' => $attributes['email'],
            ]);
            $role = $this->role->findOrFail($attributes['role']);
            $user->roles()->sync($role->id);
            return $user;
        }
        return $user;
    }
    public function delete($user)
    {
        $user = $this->user->findOrFail($user);

        if (isset($user)) {
            $user->delete();
            return true;
        }
        return false;
    }
}

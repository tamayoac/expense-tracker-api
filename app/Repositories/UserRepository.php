<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\{User, Role};
use App\Helpers\CollectionHelper;
use App\Interfaces\UserInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    public function getAll($user)
    {
        $users = $this->user->where('id', '!=', $user->id)->with("roles")->paginate(10);

        return $users;
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

            $role = $this->role->findOrFail($attributes['role']);

            $user = $this->user->create([
                'email' => $attributes['email'],
                'password' => Hash::make($attributes['password']),
            ]);

            $user->profile()->create([
                'first_name' => $attributes['first_name'],
                'last_name' => $attributes['last_name'],
                'mobile' => $attributes['mobile'],
            ]);

            $user->roles()->attach($role->id);

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
        }
        return null;
    }
    public function update(array $attributes, $user)
    {
        $user = $this->user->findOrFail($user);

        if (isset($user)) {

            $role = $this->role->findOrFail($attributes['role']);

            $user->update([
                'email' => $attributes['email'],
            ]);
            $user->profile()->update([
                'first_name' => $attributes['first_name'],
                'last_name' => $attributes['last_name'],
                'mobile' => $attributes['mobile'],
            ]);

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

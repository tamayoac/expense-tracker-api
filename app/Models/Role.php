<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends BaseModel
{
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
    public function can($action)
    {
        return $this->permissions()->where('title', $action)->first()->status;
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id');
    }
}

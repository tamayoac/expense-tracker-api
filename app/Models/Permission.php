<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends BaseModel
{
    protected $casts = [
        'status' => 'boolean',
    ];
    public static function getPermissionAccessList()
    {
        return [
            'create_user',
            'update_user',
            'delete_user',
            'view_user',
            'create_category',
            'update_category',
            'delete_category',
            'view_category',
            'create_permission',
            'update_permission',
            'delete_permission',
            'view_permission',
            'create_expense',
            'update_expense',
            'delete_expense',
            'view_expense',
            'create_role',
            'update_role',
            'delete_role',
            'view_role',
            'view_user_management',
            'view_dashboard',
            'view_expense_management'
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }
    public function getActiveAttribute()
    {
        return $this->status ? "Active" : "Inactive";
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;


    const PERMISSION_LIST = [
        'users' => [
            'create_user',
            'update_user',
            'delete_user',
            'view_user',
        ],
        'categories' => [
            'create_category',
            'update_category',
            'delete_category',
            'view_category',
        ],
        'expenses' => [
            'create_expense',
            'update_expense',
            'delete_expense',
            'view_expense',
        ],
        'permissions' => [
            'view_permissions',
        ],
        'roles' => [
            'create_role',
            'update_role',
            'delete_role',
            'view_role',
        ],
        'management' => [
            'view_user_management',
        ],
        'dashboard' => [
            'view_dashboard'
        ]
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\PermissionInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function __construct(PermissionInterface $permission)
    {
        $this->permission = $permission;
    }
    public function index()
    {
        abort_if(Gate::denies('view_permission'), Response::HTTP_FORBIDDEN);

        $permissions = $this->permission->getAll();

        return view('admin.permissions.index', [
            'permissions' => $permissions
        ]);
    }
}

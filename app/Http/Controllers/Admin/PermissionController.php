<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StorePermissionFormRequest, UpdatePermissionFormRequest};
use App\Repositories\PermissionRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function __construct(PermissionRepository $permission)
    {
        $this->permission = $permission;
    }
    public function index()
    {
        abort_if(Gate::denies('view_permissions'), Response::HTTP_FORBIDDEN);

        $permissions = $this->permission->getAll();

        return $this->successResponse($permissions);
    }
}

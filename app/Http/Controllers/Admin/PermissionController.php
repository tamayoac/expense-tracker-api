<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StorePermissionFormRequest,UpdatePermissionFormRequest};
use App\Repositories\PermissionRepository;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    public function __construct(PermissionRepository $permission)
    {
        $this->permission = $permission;
    }
    public function index()
    {
        $permissions = $this->permission->getAll();

        return $this->successResponse($permissions);
    }
    public function store(StorePermissionFormRequest $request)
    {
        $validated = $request->validated();

        $permission = $this->permission->create($validated);

        return $this->successResponse($permission, Response::HTTP_CREATED);
    }
    public function show($permission)
    {   
        return $this->successResponse($this->permission->getById($permission));
    }
    public function update(UpdatePermissionFormRequest $request, $permission)
    {   
        $validated = $request->validated();
       
        $permission = $this->permission->update($validated, $permission);

        return $this->successResponse($permission);
    }
    public function destory($permission) 
    {
        $permission = $this->permission->delete($permission);

        return $this->successResponse($permission);
    }
}

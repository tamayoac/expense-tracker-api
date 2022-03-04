<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreRoleFormRequest, UpdateRoleFormRequest};
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    
    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }
    public function index()
    {
        abort_if(Gate::denies('view_role'), Response::HTTP_FORBIDDEN);
       
        $roles = $this->role->getAll();

        return $this->successResponse($roles);
    }
    public function store(StoreRoleFormRequest $request)
    {
        abort_if(Gate::denies('create_role'), Response::HTTP_FORBIDDEN);

        $validated = $request->validated();

        $role = $this->role->create($validated);

        return $this->successResponse($role, Response::HTTP_CREATED);
    }
    public function show($role)
    {
        abort_if(Gate::denies('view_role'), Response::HTTP_FORBIDDEN);

        return $this->successResponse($this->role->getById($role));
    }
    public function update(UpdateRoleFormRequest $request, $role)
    {
        abort_if(Gate::denies('update_role'), Response::HTTP_FORBIDDEN);

        $validated = $request->validated();
       
        $role = $this->role->update($validated, $role);

        return $this->successResponse($role);
    }
    public function destory($role) 
    {
        abort_if(Gate::denies('delete_role'), Response::HTTP_FORBIDDEN);

        $role = $this->role->delete($role);

        return $this->successResponse($role);
    }

}

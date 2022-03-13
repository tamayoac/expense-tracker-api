<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreRoleFormRequest, UpdateRoleFormRequest};
use App\Interfaces\RoleInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;

class RoleController extends Controller
{

    public function __construct(RoleInterface $role)
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
        $validated = $request->validated();

        $role = $this->role->create($validated);

        return $this->successResponse($role, Response::HTTP_CREATED);
    }
    public function update(UpdateRoleFormRequest $request, $role)
    {
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
    public function selectroles()
    {
        $roles = $this->role->getAllSelect();

        return $this->successResponse($roles);
    }
}

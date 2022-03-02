<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreRoleFormRequest, UpdateRoleFormRequest};
use App\Repositories\RoleRepository;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    
    public function __construct(RoleRepository $role)
    {
        $this->role = $role;
    }
    public function index()
    {
        $roles = $this->role->getAll();

        return $this->successResponse($roles);
    }
    public function store(StoreRoleFormRequest $request)
    {
        $validated = $request->validated();

        $role = $this->role->create($validated);

        return $this->successResponse($role, Response::HTTP_CREATED);
    }
    public function show($role)
    {   
        return $this->successResponse($this->role->getById($role));
    }
    public function update(UpdateRoleFormRequest $request, $role)
    {   
        $validated = $request->validated();
       
        $role = $this->role->update($validated, $role);

        return $this->successResponse($role);
    }
    public function destory($role) 
    {
        $role = $this->role->delete($role);

        return $this->successResponse($role);
    }

}

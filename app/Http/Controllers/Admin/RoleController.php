<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Response;
use App\Interfaces\RoleInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Interfaces\PermissionInterface;
use App\Http\Requests\{StoreRoleFormRequest, UpdateRoleFormRequest};

class RoleController extends Controller
{

    public function __construct(RoleInterface $role, PermissionInterface $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }
    public function index()
    {

        abort_if(Gate::denies('view_role'), Response::HTTP_FORBIDDEN);

        $roles = $this->role->getAll();

        return view('admin.roles.index', [
            'roles' => $roles
        ]);
    }
    public function store(StoreRoleFormRequest $request)
    {
        $validated = $request->validated();

        $this->role->create($validated);

        return redirect()->route('roles.index');
    }
    public function create()
    {
        abort_if(Gate::denies('create_role'), Response::HTTP_FORBIDDEN);

        $permissions = $this->permission->getAllSelect();

        return view('admin.roles.create', [
            "permissions" => $permissions
        ]);
    }
    public function show(Role $role)
    {
        $permissions = $this->permission->getAllSelect();

        return view('admin.roles.show', [
            "role" =>  $role,
            "permissions" => $permissions
        ]);
    }
    public function update(UpdateRoleFormRequest $request, $role)
    {
        $validated = $request->validated();

        $role = $this->role->update($validated, $role);

        $permissions = $this->permission->getAll();

        return redirect()->route('roles.show', [$role])->with([
            "role" =>  $role,
            "permissions" => $permissions
        ]);
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

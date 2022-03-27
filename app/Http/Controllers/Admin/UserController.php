<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Response;
use App\Interfaces\{UserInterface, RoleInterface};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreUserFormRequest;
use App\Http\Requests\UpdateUserFormRequest;


class UserController extends Controller
{
    public function __construct(UserInterface $user, RoleInterface $roles)
    {
        $this->roles = $roles;
        $this->user = $user;
    }
    public function index()
    {
        abort_if(Gate::denies('view_user'), Response::HTTP_FORBIDDEN);

        $user = auth()->user();

        $users = $this->user->getAll($user);

        return view('admin.users.index', [
            'users' => $users
        ]);
    }
    public function create()
    {
        abort_if(Gate::denies('create_user'), Response::HTTP_FORBIDDEN);

        $roles = $this->roles->getAllSelect();

        return view('admin.users.create', [
            "roles" => $roles
        ]);
    }
    public function show(User $user)
    {
        $roles = $this->roles->getAllSelect();
        return view('admin.users.show', [
            "user" => $user,
            "roles" => $roles
        ]);
    }
    public function store(StoreUserFormRequest $request)
    {
        $validated = $request->validated();

        $this->user->create($validated);

        $this->user->getAll(auth()->user());

        return redirect()->route('users.index');
    }
    public function update(UpdateUserFormRequest $request, $user)
    {
        $validated = $request->validated();

        $user = $this->user->update($validated, $user);

        return redirect()->route('users.index')->with([
            "user" => $user
        ]);
    }
    public function destory($user)
    {
        abort_if(Gate::denies('delete_user'), Response::HTTP_FORBIDDEN);

        $user = $this->user->delete($user);

        return $this->successResponse($user);
    }
}

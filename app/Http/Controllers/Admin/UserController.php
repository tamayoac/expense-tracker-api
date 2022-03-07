<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserFormRequest;
use App\Http\Requests\UpdateUserFormRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        abort_if(Gate::denies('view_user'), Response::HTTP_FORBIDDEN);
        $user = auth()->user();

        $users = $this->user->getAll($user);

        return $this->successResponse($users);
    }
    public function store(StoreUserFormRequest $request)
    {
        $validated = $request->validated();

        $user = $this->user->create($validated);

        return $this->successResponse($user, Response::HTTP_CREATED);
    }
    public function update(UpdateUserFormRequest $request, $user)
    {
        $validated = $request->validated();

        $user = $this->user->update($validated, $user);

        return $this->successResponse($user);
    }
    public function destory($user)
    {
        abort_if(Gate::denies('delete_user'), Response::HTTP_FORBIDDEN);

        $user = $this->user->delete($user);

        return $this->successResponse($user);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserFormRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class UserController extends Controller
{   
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        $users = $this->user->getAll();

        return $this->successResponse($users);
    }
    public function store(StoreUserFormRequest $request)
    {
        $validated = $request->validated();

        $user = $this->user->create($validated);

        return $this->successResponse($user, Response::HTTP_CREATED);
    }
}

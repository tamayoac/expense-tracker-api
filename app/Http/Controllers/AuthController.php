<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StorePasswordResetFormRequest;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();
            $token = $user->createToken($user->email . '_' . now());
            $expire = $token->token->expires_at->diffInSeconds();

            return $this->validResponse([
                "access_token" => $token->accessToken,
                "expires_in" => $expire
            ]);
        }
        return $this->errorResponse("Invalid Username or Password", 400);
    }
    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return $this->validResponse([
            "message" => "Successfully Logout"
        ]);
    }
    public function me()
    {
        $user = auth()->user();
        return $this->validResponse([
            "user" => $user,
            "role" =>  $user->getRole(),
            "permissions" => $user->roles()->first()->permissions()->pluck('title')
        ]);
    }
    public function passwordReset(StorePasswordResetFormRequest $request)
    {
        $validated = $request->validated();

        $user =  auth()->user();

        if ($user) {
            $user->update(['password' => Hash::make($validated['new_password'])]);

            return $this->validResponse([
                "message" => "Successfully Updated"
            ]);
        }
        return $this->errorResponse([
            "message" => "Error User not Found"
        ], 500);
    }
}

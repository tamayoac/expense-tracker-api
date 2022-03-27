<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ClientAuthFormRequest;
use App\Http\Requests\StorePasswordResetFormRequest;

class AuthController extends Controller
{
    public function login(ClientAuthFormRequest $request)
    {
        $validated = $request->validated();
        if (auth()->attempt($validated)) {
            $user = auth()->user();
            $token = $user->createToken($user->email . '_' . now());
            $expire = $token->token->expires_at->diffInSeconds();

            return $this->validResponse([
                "access_token" => $token->accessToken,
                "expires_in" => $expire,
            ]);
        }
        return $this->errorResponse("Incorrect Credentials", 400);
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
        $user = auth()->user()->load(['profile']);
        return $this->validResponse([
            "user" => $user,
            // "permissions" => $user->roles()->first()->permissions()->pluck('title')
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

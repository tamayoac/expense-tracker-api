<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth()->user();
            $token = $user->createToken($user->email . '_' . now());
           
            $expire = $token->token->expires_at->diffInSeconds(Carbon::now());

            return $this->validResponse([
                "access_token" => $token->accessToken,
                "expires_in" => $expire
            ]);
        }
        return $this->errorResponse("Invalid Username or Password", 400);
    }
    public function logout()
    {
        auth()->user()->tokens->each(function($token, $key) {
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
            "role" =>  $user->getRole()
        ]);
    }
    public function userpermissions()
    {
        $permissions = auth()->user()->roles()->first()->permissions()->pluck('title');

        return $this->validResponse([
            "permissions" => $permissions
        ]);
    }
}

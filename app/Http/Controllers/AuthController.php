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
            $user['role'] = $user->getRole();
            $token = $user->createToken($user->email . '_' . now());
           
            $expire = $token->token->expires_at->diffInSeconds(Carbon::now());

            return $this->validResponse([
                "user" => $user,
                "access_token" => $token->accessToken,
                "expires_in" => $expire
            ]);
           
        }
        return $this->errorResponse("Invalid Username or Password", 400);
    }
    public function logout()
    {

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $data_login = $request->validated();
        $data_login = $data_login;
        $auth = Auth::attempt($data_login);
        if ($auth) {
            $user = Auth::user();
            $token = $user->createToken('frontEnd', $user->role)->plainTextToken;
            $user['token'] = $token;
            return $this->response(code: 200, data: $user);
        } else {
            return $this->response(401);
        }
    }
}

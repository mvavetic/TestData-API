<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register (Request $request)
    {
        $user = new User();

        $validator = $this->validation->make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $request['password'] = $this->hash->make($request['password']);

        $user->create($request->toArray());

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        $response = ['token' => $token];

        return response($response, 200);
    }

    public function login (Request $request)
    {
        $user = new User();

        $thisUser = $user->where('email', $request->email)->first();

        if ($thisUser) {
            if ($this->hash->check($request['password'], $thisUser['password'])) {
                $token = $thisUser->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response = "Password mismatch";
                return response($response, 422);
            }
        } else {
            $response = 'User does not exist';
            return response($response, 422);
        }
    }

    public function logout (Request $request)
    {
        $token = $request->user()->token();

        $token->revoke();

        $response = 'You have been successfully logged out!';

        return response($response, 200);
    }
}
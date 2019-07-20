<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Registers the user
     *
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register (RegistrationRequest $request)
    {
        $data = $request->validateData();

        $this->hash->make($data['password']);

        $userRepository = new UserRepository();

        $user = $userRepository->create($data);

        $userMapper = new UserResource($user);

        return $this->response->json($userMapper, 200);
    }

    /**
     * Logs in the user
     *
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login (Request $request)
    {
        $user = new User();

        $thisUser = $user->where('email', $request->email)->first();

        if ($thisUser) {
            if ($this->hash->check($request['password'], $thisUser['password'])) {
                $token = $thisUser->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return $this->response->json($response, 200);
            } else {
                $response = "Password mismatch";
                return $this->response->json($response, 422);
            }
        } else {
            $response = 'User does not exist';
            return $this->response->json($response, 422);
        }
    }

    /**
     * Logs out the user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout (Request $request)
    {
        $token = $request->user()->token();

        $token->revoke();

        $response = 'You have been successfully logged out!';

        return $this->response->json($response, 200);
    }
}
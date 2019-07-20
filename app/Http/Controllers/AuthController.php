<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogoutRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Registers the user
     *
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegistrationRequest $request) : JsonResponse
    {
        $data = $request->validateData();

        $this->hash->make($data['password']);

        $userRepository = new UserRepository();

        $user = $userRepository->create($data);

        $userMapper = new UserResource($user);

        return new JsonResponse($userMapper, 200);
    }

    /**
     * Logs in the user
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request) : JsonResponse
    {
        $data = $request->validateData();

        $userRepository = new UserRepository();

        $user = $userRepository->findByEmail($data['email']);

        if ($user) {
            if ($this->hash->check($data['password'], $user['password'])) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return new JsonResponse($response, 200);
            } else {
                $response = "Password mismatch";
                return new JsonResponse($response, 200);
            }
        } else {
            $response = 'User does not exist';
            return new JsonResponse($response, 200);
        }
    }

    /**
     * Logs out the user
     *
     * @param LogoutRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(LogoutRequest $request) : JsonResponse
    {
        $token = $request->getToken();

        $token->revoke();

        $response = 'You have been successfully logged out!';

        return new JsonResponse($response, 200);
    }
}
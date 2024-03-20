<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserAuthRequest;
use App\Http\Requests\User\UserRegistrationRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $_userService;
    public function __construct(UserService $userService)
    {
        $this->_userService = $userService;
    }
    public function registration(UserRegistrationRequest $request)
    {
        return response()
            ->json(new UserResource($this->_userService->registration($request->validated())))
            ->setStatusCode(201);
    }
    public function auth(UserAuthRequest $request)
    {
        $user = $this->_userService->auth($request->validated());
        return response()
            ->json([
                "user" => new UserResource($user[0]),
                "token" => $user[1]
            ])
            ->setStatusCode(200);
    }
}

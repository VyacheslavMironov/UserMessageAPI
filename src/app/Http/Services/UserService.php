<?php

namespace App\Http\Services;

use App\Http\Domain\Contract\UserServiceInterface;
use App\Models\User;

class UserService implements UserServiceInterface
{
    public function registration(array $request): User
    {
        return User::create($request);
    }

    public function auth(array $request): array
    {
        $user = User::where('email', '=', $request['email'])->first();
        if ($user->password == $request['password'])
        {
            return [$user, User::createBearerToken($user)];
        }
        else
        {
            return ['message' => 'Не верный логин или пароль!'];
        }
    }
    public function show(int $id)
    {
        return User::find($id);
    }
}

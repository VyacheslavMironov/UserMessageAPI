<?php
namespace App\Http\Domain\Contract;

use App\Models\User;

interface UserServiceInterface
{
    public function registration(array $request): User;
    public function auth(array $request): array;
}

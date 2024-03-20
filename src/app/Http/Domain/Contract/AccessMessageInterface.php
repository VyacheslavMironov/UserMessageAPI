<?php

namespace App\Http\Domain\Contract;

use App\Models\AccessUserToMessage;
use App\Models\Messages;
use Illuminate\Database\Eloquent\Collection;

interface AccessMessageInterface
{
    public function create(array $request): bool;
    public function exists(int $message_id, int $user_id): AccessUserToMessage;
}

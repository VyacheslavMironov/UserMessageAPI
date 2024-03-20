<?php

namespace App\Http\Domain\Contract;

use App\Models\AccessUserToMessage;
use App\Models\Messages;
use Illuminate\Database\Eloquent\Collection;

interface AccessMessageInterface
{
    public function create(array $request): AccessUserToMessage;
    public function show(int $message_id): Collection;
    public function update(array $request): AccessUserToMessage;
    public function delete(AccessUserToMessage $context): bool;
}

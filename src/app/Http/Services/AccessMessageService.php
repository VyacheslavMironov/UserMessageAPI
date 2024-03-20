<?php

namespace App\Http\Services;

use App\Http\Domain\Contract\AccessMessageInterface;
use App\Models\AccessUserToMessage;
use Illuminate\Database\Eloquent\Collection;

class AccessMessageService implements AccessMessageInterface
{

    public function create(array $request): AccessUserToMessage
    {
        // TODO: Implement create() method.
    }

    public function show(int $message_id): Collection
    {
        // TODO: Implement show() method.
    }

    public function update(array $request): AccessUserToMessage
    {
        // TODO: Implement update() method.
    }

    public function delete(AccessUserToMessage $context): bool
    {
        // TODO: Implement delete() method.
    }
}

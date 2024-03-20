<?php

namespace App\Http\Services;

use App\Http\Domain\Contract\AccessMessageInterface;
use App\Models\AccessUserToMessage;
use Illuminate\Database\Eloquent\Collection;

class AccessMessageService implements AccessMessageInterface
{

    public function create(array $request): bool
    {
        $access = new AccessUserToMessage();
        $access->message_id = $request['message_id'];
        $access->user_id = $request['user_id'];
        return $access->save();
    }
    public function exists(int $message_id, int $user_id): AccessUserToMessage
    {
        return AccessUserToMessage::where(['message_id' => $message_id, 'user_id' => $user_id])->first();
    }
}

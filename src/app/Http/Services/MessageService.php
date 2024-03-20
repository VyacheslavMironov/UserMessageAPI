<?php

namespace App\Http\Services;

use App\Http\Domain\Contract\MessageServiceInterface;
use App\Models\Messages;
use Illuminate\Database\Eloquent\Collection;

class MessageService implements MessageServiceInterface
{
    private AccessMessageService $_accessMessageService;
    private UserService $_userService;
    public function __construct(AccessMessageService $accessMessageService, UserService $userService)
    {
        $this->_accessMessageService = $accessMessageService;
        $this->_userService = $userService;
    }
    public function create(array $request): Messages
    {
        $messageContext = Messages::create($request);
        if ($messageContext && key_exists('access_users', $request) && strlen($request['access_users']) > 0)
        {
            foreach (explode(',', $request['access_users']) as $item)
            {
                if ($this->_userService->show($item))
                {
                    $this->_accessMessageService->create(['message_id' => $messageContext, 'user_id' => $item]);
                }
            }
        }
        return $messageContext;
    }

    public function show(int $id): Messages
    {
        return Messages::find($id);
    }

    public function all(): Collection
    {
        return Messages::all();
    }

    public function update(Messages $context, array $request): Messages
    {
        $context->text = key_exists("text", $request) && !is_null($request['text']) ? $request['text'] : $context->text;
        $context->rule = key_exists("rule", $request) && !is_null($request['rule']) ? $request['rule'] : $context->rule;
        $context->save();
        return $context;
    }

    public function delete(Messages $context): bool
    {
        return $context->delete();
    }
}

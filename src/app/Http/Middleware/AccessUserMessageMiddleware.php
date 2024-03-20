<?php

namespace App\Http\Middleware;

use App\Http\Services\AccessMessageService;
use App\Http\Services\MessageService;
use App\Http\Services\UserService;
use App\Models\AccessUserToMessage;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessUserMessageMiddleware
{
    private UserService $_userService;
    private AccessMessageService $_accessMessageService;
    private MessageService $_messageService;
    public function __construct(
        UserService $userService,
        AccessMessageService $accessMessageService,
        MessageService $messageService
    )
    {
        $this->_userService = $userService;
        $this->_accessMessageService = $accessMessageService;
        $this->_messageService = $messageService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->_messageService->show($request['id'])->rule == 'concrete_visible')
        {
            $user = $this->_userService->show(User::getUserByToken(
                explode(' ', $request->headers->get('authorization'))[2]
            )->tokenable_id);
            if (
                // Поользователь имеет доступ
                !is_null($this->_accessMessageService->exists($request->id, $user->id)) ||
                // Поользователь владелец
                $this->_messageService->show($request->id)->owner_id == $user->id
            )
            {
                return $next($request);
            }
            throw new \Exception('У вас нет доступа к сообщению!');
        }
        return $next($request);
    }
}

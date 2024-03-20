<?php

namespace App\Http\Middleware;

use App\Http\Services\MessageService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessAuthToMessageMiddleware
{
    private MessageService $_messageService;
    public function __construct(MessageService $messageService)
    {
        $this->_messageService = $messageService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->_messageService->show($request->id)->rule === 'auth_visible' && !$request->headers->get('authorization'))
        {
            throw new \Exception('Только авторизированные пользователи могут просматривать это сообщение!');
        }
        return $next($request);
    }
}

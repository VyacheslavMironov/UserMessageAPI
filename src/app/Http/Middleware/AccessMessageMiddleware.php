<?php

namespace App\Http\Middleware;

use App\Models\AccessUserToMessage;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessMessageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        foreach (AccessUserToMessage::where('message_id', '=', $request->message_id) as $access_user)
        {
            if (session()->get('user_id') == $access_user->user_id)
            {
                return $next($request);
            }
        }
        return response()->json(['message' => 'У вас нет доступа к сообщению!']);
    }
}

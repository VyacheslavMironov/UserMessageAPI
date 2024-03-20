<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Messages\MessageCreateRequest;
use App\Http\Requests\Messages\MessageShowRequest;
use App\Http\Requests\Messages\MessageUpdateRequest;
use App\Http\Resources\Messages\MessageResource;
use App\Http\Services\AccessMessageService;
use App\Http\Services\MessageService;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private MessageService $_messageService;
    private UserService $_userService;
    private AccessMessageService $_accessMessageService;
    public function __construct(
        UserService $userService,
        MessageService $messageService,
        AccessMessageService $accessMessageService
    )
    {
        $this->_userService = $userService;
        $this->_messageService = $messageService;
        $this->_accessMessageService = $accessMessageService;
    }
    public function create(MessageCreateRequest $request)
    {
        return response()
            ->json(new MessageResource($this->_messageService->create($request->validated())))
            ->setStatusCode(201);
    }
    public function show(Request $request, int $id)
    {
//        return response()
//            ->json(new MessageResource($this->_messageService->show($id)))
//            ->setStatusCode(200);
    }
    public function all()
    {
        return response()
            ->json(MessageResource::collection($this->_messageService->all()))
            ->setStatusCode(200);
    }
    public function update(MessageUpdateRequest $request)
    {
        $message = $request->validated();
        return response()
            ->json(new MessageResource($this->_messageService->update(
                $this->_messageService->show($message['id']),
                $message
            )))
            ->setStatusCode(201);
    }
    public function delete(int $id)
    {
        return response()
            ->json($this->_messageService->delete(
                $this->_messageService->show($id)
            ))
            ->setStatusCode(201);
    }
}

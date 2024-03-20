<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Messages\Comments\MessageCommentCreateRequest;
use App\Http\Requests\Messages\Comments\MessageCommentUpdateRequest;
use App\Http\Resources\Messages\MessageCommentCollectionResource;
use App\Http\Resources\Messages\MessageCommentResource;
use App\Http\Services\MessageCommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private MessageCommentService $_commentService;
    public function __construct(MessageCommentService $commentService)
    {
        $this->_commentService = $commentService;
    }
    public function create(MessageCommentCreateRequest $request)
    {
        return response()->json(
            new MessageCommentResource($this->_commentService->create($request->validated()))
        )->setStatusCode(201);
    }
    public function show(int $id)
    {
        return response()->json(
            new MessageCommentResource($this->_commentService->show($id))
        )->setStatusCode(200);
    }
    public function all(int $message_id)
    {
        return response()->json(
            MessageCommentCollectionResource::collection($this->_commentService->all($message_id))
        )->setStatusCode(200);
    }
    public function update(MessageCommentUpdateRequest $request)
    {
        $comment = $request->validated();
        return response()->json(
            new MessageCommentResource($this->_commentService->update(
                $this->_commentService->show($comment['id']),
                $comment
            ))
        )->setStatusCode(201);
    }
    public function delete(int $id)
    {
        return response()->json(
            $this->_commentService->delete(
                $this->_commentService->show($id)
            )
        )->setStatusCode(201);
    }
}

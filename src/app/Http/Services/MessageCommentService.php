<?php

namespace App\Http\Services;

use App\Http\Domain\Contract\MessageCommentServiceInterface;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class MessageCommentService implements MessageCommentServiceInterface
{

    public function create(array $request): Comment
    {
        return Comment::create($request);
    }

    public function show(int $id): Comment
    {
        return Comment::find($id);
    }

    public function all(int $message_id): Collection
    {
        return Comment::where('message_id', '=', $message_id)->get();
    }

    public function update(Comment $context, array $request): Comment
    {
        $context->text = key_exists('text', $request) && !is_null($request['text']) ? $request['text'] : $context->text;
        $context->save();
        return $context;
    }

    public function delete(Comment $context): bool
    {
        return $context->delete();
    }
}

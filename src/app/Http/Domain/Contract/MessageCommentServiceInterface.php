<?php

namespace App\Http\Domain\Contract;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

interface MessageCommentServiceInterface
{
    public function create(array $request): Comment;
    public function show(int $id): Comment;
    public function all(int $message_id): Collection;
    public function update(Comment $context, array $request): Comment;
    public function delete(Comment $context): bool;
}

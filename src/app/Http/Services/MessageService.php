<?php

namespace App\Http\Services;

use App\Http\Domain\Contract\MessageServiceInterface;
use App\Models\Messages;
use Illuminate\Database\Eloquent\Collection;

class MessageService implements MessageServiceInterface
{

    public function create(array $request): Messages
    {
        return Messages::create($request);
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

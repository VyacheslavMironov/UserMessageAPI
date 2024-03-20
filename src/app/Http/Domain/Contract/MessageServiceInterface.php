<?php

namespace App\Http\Domain\Contract;

use App\Models\Messages;
use Illuminate\Database\Eloquent\Collection;

interface MessageServiceInterface
{
    public function create(array $request): Messages;
    public function show(int $id): Messages;
    public function all(): Collection;
    public function update(Messages $context, array $request): Messages;
    public function delete(Messages $context): bool;
}

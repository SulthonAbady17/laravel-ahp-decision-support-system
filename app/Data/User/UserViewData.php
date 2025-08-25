<?php

namespace App\Data\User;

use App\Models\User;
use Carbon\Carbon;

class UserViewData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $role,
        public readonly string $createdAtFormatted,
    ) {}

    public static function fromModel(User $user): self
    {
        return new self(
            id: $user->id,
            name: $user->name,
            email: $user->email,
            role: $user->role,
            createdAtFormatted: Carbon::parse($user->created_at)->isoFormat('D MMM YYYY'),
        );
    }
}

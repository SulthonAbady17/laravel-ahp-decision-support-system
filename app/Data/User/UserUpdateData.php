<?php

namespace App\Data\User;

class UserUpdateData
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $role,
    ) {}
}

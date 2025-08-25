<?php

namespace App\Data\User;

class UserCreateData
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly string $role,
    ) {}
}

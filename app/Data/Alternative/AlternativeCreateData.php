<?php

namespace App\Data\Alternative;

class AlternativeCreateData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $details,
    ) {}
}

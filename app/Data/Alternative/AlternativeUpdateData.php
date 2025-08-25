<?php

namespace App\Data\Alternative;

class AlternativeUpdateData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $details,
    ) {}
}

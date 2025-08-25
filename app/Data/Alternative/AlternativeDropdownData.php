<?php

namespace App\Data\Alternative;

use App\Models\Alternative;

class AlternativeDropdownData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {}

    public static function fromModel(Alternative $alternative): self
    {
        return new self(
            id: $alternative->id,
            name: $alternative->name,
        );
    }
}

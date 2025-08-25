<?php

namespace App\Data\Alternative;

use App\Models\Alternative;

class AlternativeViewData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $details,
    ) {}

    public static function fromModel(Alternative $alternative): self
    {
        return new self(
            id: $alternative->id,
            name: $alternative->name,
            details: $alternative->details,
        );
    }
}

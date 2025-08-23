<?php

namespace App\Data\Criterion;

use App\Models\Criterion;

class CriterionViewData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?string $description,
    ) {}

    public static function fromModel(Criterion $criterion): self
    {
        return new self(
            id: $criterion->id,
            name: $criterion->name,
            description: $criterion->description,
        );
    }
}

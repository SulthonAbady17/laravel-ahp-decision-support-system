<?php

namespace App\Data\Criterion;

class UpdateCriterionData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description,
    ) {}
}

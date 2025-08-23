<?php

namespace App\Data\Criterion;

class CreateCriterionData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description,
    ) {}
}

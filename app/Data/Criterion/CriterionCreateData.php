<?php

namespace App\Data\Criterion;

class CriterionCreateData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description,
    ) {}
}

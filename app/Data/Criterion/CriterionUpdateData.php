<?php

namespace App\Data\Criterion;

class CriterionUpdateData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description,
    ) {}
}

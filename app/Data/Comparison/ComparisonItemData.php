<?php

namespace App\Data\Comparison;

class ComparisonItemData
{
    public function __construct(
        public readonly int $item1Id,
        public readonly int $item2Id,
        public readonly string $value,
        public readonly ?int $criterionId = null,
    ) {}
}

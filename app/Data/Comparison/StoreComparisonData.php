<?php

namespace App\Data\Comparison;

class StoreComparisonData
{
    /**
     * @param int $periodId
     * @param array<int, \App\Data\Comparison\ComparisonItemData> $criteriaComparisons
     * @param array<int, \App\Data\Comparison\ComparisonItemData> $alternativeComparisons
     */
    public function __construct(
        public readonly int $periodId,
        public readonly array $criteriaComparisons,
        public readonly array $alternativeComparisons,
    ) {}
}

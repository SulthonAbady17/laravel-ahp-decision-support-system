<?php

namespace App\Data\Period;

use App\Models\Period;
use Illuminate\Support\Collection;

class PeriodConfigurationData
{
    /**
     * @param \App\Models\Period $period
     * @param \Illuminate\Support\Collection<int, \App\Data\Criterion\CriterionDropdownData> $allCriteria
     * @param \Illuminate\Support\Collection<int, \App\Data\Alternative\AlternativeDropdownData> $allAlternatives
     * @param array<int> $selectedCriteriaIds
     * @param array<int> $selectedAlternativesIds
     */
    public function __construct(
        public readonly Period $period,
        public readonly Collection $allCriteria,
        public readonly Collection $allAlternatives,
        public readonly array $selectedCriteriaIds,
        public readonly array $selectedAlternativesIds,
    ) {}
}

<?php

namespace App\Data\Period;

use Illuminate\Support\Collection;

class PeriodConfigurationViewData
{
    /**
     * @param  \Illuminate\Support\Collection<int, \App\Data\Criterion\CriterionDropdownData>  $allCriteria
     * @param  \Illuminate\Support\Collection<int, \App\Data\Alternative\AlternativeDropdownData>  $allAlternatives
     * @param  \Illuminate\Support\Collection<int, int>  $selectedCriteriaIds
     * @param  \Illuminate\Support\Collection<int, int>  $selectedAlternativesIds
     */
    public function __construct(
        public readonly PeriodViewData $period,
        public readonly Collection $allCriteria,
        public readonly Collection $allAlternatives,
        public readonly Collection $selectedCriteriaIds,
        public readonly Collection $selectedAlternativesIds,
    ) {}
}

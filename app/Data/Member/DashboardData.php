<?php

namespace App\Data\Member;

use App\Data\Period\PeriodViewData;

class DashboardData
{
    public function __construct(
        public readonly ?PeriodViewData $activePeriod,
        public readonly ?PeriodViewData $latestCompletedPeriod
    ) {}
}

<?php

namespace App\Data\Member;

use App\Data\Period\PeriodViewData;

class DashboardData
{
    public function __construct(
        public readonly ?PeriodViewData $activePeriod, // Bisa null jika tidak ada periode aktif
    ) {}
}

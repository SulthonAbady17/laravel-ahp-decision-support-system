<?php

namespace App\Data\Admin;

class DashboardData
{
    public function __construct(
        public readonly int $criteriaCount,
        public readonly int $alternativesCount,
        public readonly int $periodsCount,
    ) {}
}

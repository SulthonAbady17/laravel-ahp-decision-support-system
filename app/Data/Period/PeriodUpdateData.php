<?php

namespace App\Data\Period;

class PeriodUpdateData
{
    public function __construct(
        public readonly string $name,
        public readonly string $status,
        public readonly ?string $start_date,
        public readonly ?string $end_date,
    ) {}
}

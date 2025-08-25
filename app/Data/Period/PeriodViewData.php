<?php

namespace App\Data\Period;

use App\Models\Period;
use Carbon\Carbon;

class PeriodViewData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $status,
        public readonly ?string $startDateFormatted,
        public readonly ?string $endDateFormatted,
    ) {}

    public static function fromModel(Period $period): self
    {
        return new self(
            id: $period->id,
            name: $period->name,
            status: $period->status,
            startDateFormatted: $period->start_date ? Carbon::parse($period->start_date)->isoFormat('D MMM YYYY') : null,
            endDateFormatted: $period->end_date ? Carbon::parse($period->end_date)->isoFormat('D MMM YYYY') : null,
        );
    }
}

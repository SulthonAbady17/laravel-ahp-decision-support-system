<?php

namespace App\Data\Period;

use App\Models\Period;

class PeriodEditData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $status,
        public readonly ?string $start_date,
        public readonly ?string $end_date,
    ) {}

    public static function fromModel(Period $period): self
    {
        return new self(
            id: $period->id,
            name: $period->name,
            status: $period->status,
            start_date: $period->start_date,
            end_date: $period->end_date
        );
    }
}

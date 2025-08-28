<?php

namespace App\Data\Result;

use App\Models\Result;

class ResultViewData
{
    public function __construct(
        public readonly int $rank,
        public readonly float $score,
        public readonly string $alternativeName,
    ) {}

    public static function fromModel(Result $result): self
    {
        return new self(
            rank: $result->rank,
            score: $result->score,
            alternativeName: $result->alternative->name,
        );
    }
}

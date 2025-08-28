<?php

namespace App\Repositories;

use App\Data\Result\ResultViewData;
use App\Models\Result;
use Illuminate\Support\Collection;

class ResultRepository
{
    public function getResultsForPeriod(int $periodId): Collection
    {
        $results = Result::with('alternative:id, name')
            ->where('period_id', $periodId)
            ->orderBy('rank', 'asc')
            ->get();

        return $results->map(fn(Result $result): ResultViewData => ResultViewData::fromModel($result));
    }
}

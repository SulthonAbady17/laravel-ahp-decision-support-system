<?php

namespace App\Repositories;

use App\Data\Criterion\CriterionCreateData;
use App\Data\Criterion\CriterionDropdownData;
use App\Data\Criterion\CriterionUpdateData;
use App\Data\Criterion\CriterionViewData;
use App\Models\Criterion;
use Illuminate\Support\Collection;

class CriterionRepository
{
    public function getAllForIndex(): Collection
    {
        $criteria = Criterion::select('id', 'name', 'description')->get();

        return $criteria->map(fn($criterion) => CriterionViewData::fromModel($criterion));
    }

    public function create(CriterionCreateData $data): Criterion
    {
        return Criterion::create([
            'name' => $data->name,
            'description' => $data->description,
        ]);
    }

    public function getAllForDropdown(): Collection
    {
        $criteria = Criterion::select('id', 'name')->get();

        return $criteria->map(fn($criterion) => CriterionDropdownData::fromModel($criterion));
    }

    public function update(Criterion $criterion, CriterionUpdateData $data): bool
    {
        return $criterion->update([
            'name' => $data->name,
            'description' => $data->description,
        ]);
    }

    public function delete(Criterion $criterion): bool
    {
        return $criterion->delete();
    }
}

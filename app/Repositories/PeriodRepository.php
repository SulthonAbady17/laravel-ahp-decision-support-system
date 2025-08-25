<?php

namespace App\Repositories;

use App\Data\Period\PeriodCreateData;
use App\Data\Period\PeriodUpdateData;
use App\Data\Period\PeriodViewData;
use App\Models\Period;
use Illuminate\Support\Collection;

class PeriodRepository
{
    /**
     * Mengambil semua data periode untuk halaman index.
     */
    public function getAllForIndex(): Collection
    {
        $periods = Period::select('id', 'name', 'start_date', 'end_date', 'status')->latest()->get();

        return $periods->map(fn(Period $period) => PeriodViewData::fromModel($period));
    }

    /**
     * Membuat data periode baru.
     */
    public function create(PeriodCreateData $data): Period
    {
        return Period::create([
            'name' => $data->name,
            'start_date' => $data->start_date,
            'end_date' => $data->end_date,
            'status' => $data->status,
        ]);
    }

    /**
     * Memperbarui data periode yang ada.
     */
    public function update(Period $period, PeriodUpdateData $data): bool
    {
        return $period->update([
            'name' => $data->name,
            'start_date' => $data->start_date,
            'end_date' => $data->end_date,
            'status' => $data->status,
        ]);
    }

    /**
     * Menghapus data periode.
     */
    public function delete(Period $period): bool
    {
        return $period->delete();
    }
}

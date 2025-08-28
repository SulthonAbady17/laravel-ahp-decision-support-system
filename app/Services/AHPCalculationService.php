<?php

namespace App\Services;

use App\Models\Period;
use App\Repositories\ComparisonRepository;
use Illuminate\Support\Collection;

class AHPCalculationService
{
    public function __construct(
        private readonly ComparisonRepository $comparisonRepository
    ) {}

    /**
     * Menjalankan seluruh proses perhitungan AHP untuk periode yang diberikan.
     */
    public function calculateForPeriod(Period $period): void
    {
        // 1. Ambil semua data penilaian dari repository.
        $allInputs = $this->comparisonRepository->getAllPeriod($period->id);

        if ($allInputs->isEmpty()) {
            return;
        }

        $criteriaIds = $period->criteria()->pluck('id');
        $alternativeIds = $period->alternatives()->pluck('id');

        // 2. Lakukan agregasi dengan Rata-rata Geometrik.
        $criteriaInputs = $allInputs->where('comparison_type', 'criterion');
        $aggregatedCriterianMatrix = $this->aggregateMatrix($criteriaInputs, $criteriaIds);

        // 3. Lakukan perhitungan AHP.
        $aggreagatedAlternativeMatrices = [];
        foreach ($criteriaIds as $criterionId) {
            $alternativeInputs = $allInputs
                ->where('comparison_type', 'alternative')
                ->where('criterion_id', $criterionId);

            $aggregatedCriterianMatrix = $this->aggregateMatrix($alternativeInputs, $alternativeIds);
        }

        // 4. Simpan hasilnya ke database.
    }

    /**
     * Mengagregasi sekumpulan input perbandingan menjadi satu matriks final menggunakan rata-rata geometrik
     * @param \Illuminate\Support\Collection $inputs
     * @param \Illuminate\Support\Collection $itemIds
     * @return array<array>
     */
    private function aggregateMatrix(Collection $inputs, Collection $itemIds): array
    {
        $matrix = [];
        $itemIdsArray = $itemIds->toArray();

        foreach ($itemIdsArray as $rowId) {
            foreach ($itemIdsArray as $colId) {
                if ($rowId === $colId) {
                    $matrix[$rowId][$colId] = 1.0;
                }

                $pairInputs = $inputs->filter(function ($item) use ($rowId, $colId) {
                    return ($item->item1_id == $rowId && $item->item2_id == $colId) || ($item->item1_id == $colId && $item->item2_id == $rowId);
                });

                if ($pairInputs->isEmpty()) {
                    $matrix[$rowId][$colId] = 1.0;
                    continue;
                }

                $product = 1.0;
                foreach ($pairInputs as $input) {
                    $value = (float) $input->value;
                    if ($input->item1_id == $colId && $input->item2_id == $rowId) {
                        $product *= (1 / $value);
                    } else {
                        $product *= $value;
                    }
                }

                $geomtricMean = pow($product, 1.0 / $pairInputs->count());
                $matrix[$rowId][$colId] = $geomtricMean;
            }
        }

        return $matrix;
    }
}

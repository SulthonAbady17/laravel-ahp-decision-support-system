<?php

namespace App\Services;

use App\Models\Period;
use App\Models\Result;
use App\Repositories\ComparisonRepository;
use Illuminate\Support\Collection;

class AHPCalculationService
{
    private const RANDOM_INDEX = [1 => 0, 2 => 0, 3 => 0.58, 4 => 0.90, 5 => 1.12, 6 => 1.24, 7 => 1.32, 8 => 1.41, 9 => 1.45, 10 => 1.49];

    public function __construct(
        private readonly ComparisonRepository $comparisonRepository
    ) {}

    /**
     * Menjalankan seluruh proses perhitungan AHP untuk periode yang diberikan.
     */
    public function calculateForPeriod(Period $period): void
    {
        $allInputs = $this->comparisonRepository->getAllPeriod($period->id);

        if ($allInputs->isEmpty()) {
            return;
        }

        $criteriaIds = $period->criteria()->pluck('id');
        $alternativeIds = $period->alternatives()->pluck('id');

        // 1. Agregasi Matriks Kriteria
        $criteriaInputs = $allInputs->where('comparison_type', 'criterion');
        $aggregatedCriteriaMatrix = $this->aggregateMatrix($criteriaInputs, $criteriaIds);

        // 2. Hitung bobot dan CR untuk Kriteria
        $criteriaResult = $this->calculateAhpFromMatrix($aggregatedCriteriaMatrix);
        $criteriaWeights = $criteriaResult['priority_vector'];
        $criteriaConsistencyRatio = $criteriaResult['consistency_ratio'];

        // 3. Agregasi & Hitung bobot untuk setiap Matriks Alternatif
        $alternativeWeights = [];
        foreach ($criteriaIds as $criterionId) {
            $alternativeInputs = $allInputs->where('comparison_type', 'alternative')->where('criterion_id', $criterionId);
            $aggregatedMatrix = $this->aggregateMatrix($alternativeInputs, $alternativeIds);
            $alternativeResult = $this->calculateAhpFromMatrix($aggregatedMatrix);
            $alternativeWeights[$criterionId] = $alternativeResult['priority_vector'];
        }

        // 4. Hitung Skor Akhir
        $finalScores = [];
        foreach ($alternativeIds as $alternativeId) {
            $score = 0;
            foreach ($criteriaIds as $criterionId) {
                $score += ($alternativeWeights[$criterionId][$alternativeId] ?? 0) * ($criteriaWeights[$criterionId] ?? 0);
            }

            $finalScores[$alternativeId] = $score;
        }

        asort($finalScores);

        Result::where('period_id', $period->id)->delete();

        $rank = 1;
        foreach ($finalScores as $alternativeId => $score) {
            Result::create([
                'period_id' => $period->id,
                'alternative_id' => $alternativeId,
                'score' => $score,
                'rank' => $rank,
            ]);

            $rank++;
        }

        $period->update(['status' => 'completed']);
    }

    public function calculateAhpFromMatrix(array $matrix): array
    {
        $n = count($matrix);
        if ($n === 0) {
            return ['priority_vector' => [], 'consistency_ratio' => 0];
        }

        $columnSums = [];
        foreach ($matrix as $row) {
            foreach ($row as $colKey => $value) {
                $columnSums[$colKey] = ($columnSums[$colKey] ?? 0) + $value;
            }
        }

        $normalizedMatrix = [];
        foreach ($matrix as $rowKey => $row) {
            foreach ($row as $colKey => $value) {
                $normalizedMatrix[$rowKey][$colKey] = $value / $columnSums[$colKey];
            }
        }

        $priorityVector = [];
        foreach ($normalizedMatrix as $rowKey => $row) {
            $priorityVector[$rowKey] = array_sum($row) / $n;
        }

        $lambdaMax = 0;
        foreach ($columnSums as $key => $sum) {
            $lambdaMax += $sum * $priorityVector[$key];
        }

        $consistencyIndex = ($n > 1) ? ($lambdaMax - $n) / ($n - 1) : 0;
        $randomIndex = self::RANDOM_INDEX[$n] ?? 1.49;
        $consistencyRatio = ($randomIndex > 0) ? $consistencyIndex / $randomIndex : 0;

        return [
            'priority_vector' => $priorityVector,
            'consistency_ratio' => $consistencyRatio
        ];
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

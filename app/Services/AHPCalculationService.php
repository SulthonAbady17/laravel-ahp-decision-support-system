<?php

namespace App\Services;

use App\Models\Period;
use App\Repositories\ComparisonRepository;

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
        // TODO:
        // 1. Ambil semua data penilaian dari repository.
        $allInputs = $this->comparisonRepository->getAllPeriod($period->id);

        if ($allInputs->isEmpty()) {
            return;
        }

        // 2. Lakukan agregasi dengan Rata-rata Geometrik.
        // 3. Lakukan perhitungan AHP.
        // 4. Simpan hasilnya ke database.
    }
}

<?php

namespace App\Services;

use App\Models\Period;

class AHPCalculationService
{
    /**
     * Menjalankan seluruh proses perhitungan AHP untuk periode yang diberikan.
     */
    public function calculateForPeriod(Period $period): void
    {
        // TODO:
        // 1. Ambil semua data penilaian dari repository.
        // 2. Lakukan agregasi dengan Rata-rata Geometrik.
        // 3. Lakukan perhitungan AHP.
        // 4. Simpan hasilnya ke database.
    }
}

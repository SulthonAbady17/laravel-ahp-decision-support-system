<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Services\AHPCalculationService;
use Illuminate\Http\Request;

class PeriodCalculationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Period $period, AHPCalculationService $calculationService)
    {
        $calculationService->calculateForPeriod($period);

        return redirect()->route('admin.periods.index')->with("success", "Perhitungan untuk periode '{$period->name}' telah selesai.");
    }
}

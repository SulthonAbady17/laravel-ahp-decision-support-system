<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\StoreComparisonRequest;
use App\Http\Requests\Member\StoreCriteriaComparisonRequest;
use App\Models\Period;
use App\Repositories\ComparisonRepository;
use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    public function __construct(
        private readonly ComparisonRepository $comparisonRepository
    ) {}

    public function create()
    {
        $activePeriod = Period::where('status', 'active')
            ->with([
                'criteria:id,name',
                'alternatives:id,name'
            ])
            ->first();

        if (!$activePeriod) {
            return redirect()->route('member.dashboard')->with('error', 'Saat ini tidak ada periode penilaian yang aktif.');
        }

        $saatyOptions = [
            ['value' => '9', 'label' => '9 - Mutlak Lebih Penting'],
            ['value' => '7', 'label' => '7 - Sangat Lebih Penting'],
            ['value' => '5', 'label' => '5 - Lebih Penting'],
            ['value' => '3', 'label' => '3 - Cukup Lebih Penting'],
            ['value' => '1', 'label' => '1 - Sama Penting'],
            ['value' => '1/3', 'label' => '1/3 - Cukup Kurang Penting'],
            ['value' => '1/5', 'label' => '1/5 - Kurang Penting'],
            ['value' => '1/7', 'label' => '1/7 - Sangat Kurang Penting'],
            ['value' => '1/9', 'label' => '1/9 - Mutlak Kurang Penting'],
        ];

        return view('member.comparisons.criteria', [
            'period' => $activePeriod,
            'criteria' => $activePeriod->criteria,
            'alternatives' => $activePeriod->alternatives,
            'saatyOptions' => $saatyOptions,
        ]);
    }

    public function store(StoreCriteriaComparisonRequest $request)
    {
        $request->session()->put('comparison_date', [
            'period_id' => $request->validated('period_id'),
            'criteria_comparisons' => $request->validated('criteria_comparisons'),
        ]);

        return redirect()->route('member.comparisons.alternatives.create');
    }
}

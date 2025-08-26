<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\StoreAlternativeComparisonRequest;
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

    public function storeCriteria(StoreCriteriaComparisonRequest $request)
    {
        $request->session()->put('comparison_data', [
            'period_id' => $request->validated('period_id'),
            'criteria_comparisons' => $request->validated('criteria_comparisons'),
        ]);

        return redirect()->route('member.comparisons.alternatives.create');
    }

    public function createAlternatives(Request $request)
    {
        $comparisonData = $request->session()->get('comparison_data');

        if (!$comparisonData) {
            return redirect()->route('member.comparisons.create');
        }

        $period = Period::with('criteria:id,name', 'alternatives:id,name')
            ->find($comparisonData['period_id']);

        $currentCriterion = $period->criteria->first();

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

        return view('member.comparisons.alternatives', [
            'period' => $period,
            'alternatives' => $period->alternatives,
            'currentCriterion' => $currentCriterion,
            'saatyOptions' => $saatyOptions,
        ]);
    }

    public function storeAlternatives(StoreAlternativeComparisonRequest $request)
    {
        $comparisonData = $request->session()->get('comparison_date', []);

        $criterionId = $request->validated('criterion_id');
        $comparisons = $request->validated('comparisons', []);

        if (!isset($comparisonData['alternative_comparisons'])) {
            $comparisonData['alternative_comparisons'] = [];
        }

        $comparisonData['alternative_comparisons'] = array_merge(
            $comparisonData['alternative_comparisons'],
            $this->formatAlternativesComparisons($comparisons, $criterionId)
        );

        $request->session()->put('comparison_data', $comparisonData);

        $period = Period::with('criteria:id,name', 'alternatives:id,name')->find($comparisonData['period_id']);
        $allCriteriaIds = $period->criteria->pluck('id');

        $completedCriteriaIds = collect($comparisonData['alternative_comparisons'])->pluck('criterionId')->unique();

        $nextCriterionId = $allCriteriaIds->diff($completedCriteriaIds)->first();

        if ($nextCriterionId) {
            return redirect()->route('member.comparisons.alternatives.create', ['criterion_id' => $nextCriterionId]);
        } else {
            return redirect()->route('member.comparisons.finalize');
        }
    }

    private function formatAlternativesComparisons(array $comparisons, int $criterionId): array
    {
        $formatted = [];
        foreach ($comparisons as $comparison) {
            $formatted[] = [
                'item1_id' => $comparison['item1_id'],
                'item2_id' => $comparison['item2_id'],
                'value' => $comparison['value'],
                'criterion_id' => $criterionId,
            ];
        }

        return $formatted;
    }
}

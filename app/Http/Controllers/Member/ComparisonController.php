<?php

namespace App\Http\Controllers\Member;

use App\Data\Comparison\ComparisonItemData;
use App\Data\Comparison\StoreComparisonData;
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

        $currentCriterionId = $request->query('criterion', $period->criteria->first()->id);
        $currentCriterion = $period->criteria->find($currentCriterionId);

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
        // 1. PERBAIKAN: Gunakan kunci 'comparison_data' yang benar
        $comparisonData = $request->session()->get('comparison_data', []);

        // 2. Validasi data baru
        $criterionId = $request->validated('criterion_id');
        $comparisons = $request->validated('comparisons', []);

        // 3. Siapkan array untuk data perbandingan alternatif
        if (!isset($comparisonData['alternative_comparisons'])) {
            $comparisonData['alternative_comparisons'] = [];
        }

        // 4. Gabungkan data perbandingan alternatif yang lama dengan yang baru
        $comparisonData['alternative_comparisons'] = array_merge(
            $comparisonData['alternative_comparisons'],
            $this->formatAlternativesComparisons($comparisons, $criterionId)
        );

        // 5. Simpan kembali data yang sudah lengkap ke session
        $request->session()->put('comparison_data', $comparisonData);

        // 6. Sekarang, $comparisonData['period_id'] pasti ada.
        $period = Period::with('criteria:id')->find($comparisonData['period_id']);
        $allCriteriaIds = $period->criteria->pluck('id');

        $completedCriteriaIds = collect($comparisonData['alternative_comparisons'])->pluck('criterion_id')->unique();
        // dd($comparisonData['alternative_comparisons']);

        $nextCriterionId = $allCriteriaIds->diff($completedCriteriaIds)->first();

        if ($nextCriterionId) {
            // PERBAIKAN: Kirim parameter dengan nama 'criterion' agar sesuai dengan method createAlternatives
            return redirect()->route('member.comparisons.alternatives.create', ['criterion' => $nextCriterionId]);
        } else {
            return redirect()->route('member.comparisons.finalize');
        }
    }

    public function finalize(Request $request)
    {
        // 1. Ambil semua data yang terkumpul dari session
        $sessionData = $request->session()->get('comparison_data');

        // Jika tidak ada data, kembalikan ke awal
        if (!$sessionData) {
            return redirect()->route('member.comparisons.create');
        }

        // 2. Ubah data dari session menjadi DTO yang rapi
        $criteriaComparisons = [];
        foreach ($sessionData['criteria_comparisons'] ?? [] as $item) {
            $criteriaComparisons[] = new ComparisonItemData(
                item1Id: $item['item1_id'],
                item2Id: $item['item2_id'],
                value: $item['value']
            );
        }

        $alternativeComparisons = [];
        foreach ($sessionData['alternative_comparisons'] ?? [] as $item) {
            $alternativeComparisons[] = new ComparisonItemData(
                item1Id: $item['item1_id'],
                item2Id: $item['item2_id'],
                value: $item['value'],
                criterionId: $item['criterion_id']
            );
        }

        $finalDto = new StoreComparisonData(
            periodId: $sessionData['period_id'],
            criteriaComparisons: $criteriaComparisons,
            alternativeComparisons: $alternativeComparisons
        );

        // 3. Panggil repository untuk menyimpan DTO ke database
        $this->comparisonRepository->storeForUser($finalDto, $request->user());

        // 4. Hapus data dari session setelah berhasil disimpan
        $request->session()->forget('comparison_data');

        // 5. Arahkan ke halaman selesai
        return redirect()->route('member.complete')->with('success', 'Penilaian Anda telah berhasil disimpan.');
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

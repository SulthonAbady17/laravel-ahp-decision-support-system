<?php

namespace App\Http\Controllers\Admin;

use App\Data\Period\PeriodConfigurationViewData;
use App\Data\Period\PeriodViewData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePeriodConfigurationRequest;
use App\Models\Period;
use App\Repositories\AlternativeRepository;
use App\Repositories\CriterionRepository;

class PeriodConfigurationController extends Controller
{
    public function __construct(
        private readonly CriterionRepository $criterionRepository,
        private readonly AlternativeRepository $alternativeRepository,
    ) {}

    public function edit(Period $period)
    {
        $allCriteria = $this->criterionRepository->getAllForDropdown();
        $allAlternatives = $this->alternativeRepository->getAllForDropdown();

        $selectedCriteriaIds = $period->criteria()->pluck('criteria.id');
        $selectedAlternativesIds = $period->alternatives()->pluck('alternatives.id');

        $viewData = new PeriodConfigurationViewData(
            period: PeriodViewData::fromModel($period),
            allCriteria: $allCriteria,
            allAlternatives: $allAlternatives,
            selectedCriteriaIds: $selectedCriteriaIds,
            selectedAlternativesIds: $selectedAlternativesIds,
        );

        return view('admin.periods.configure', ['data' => $viewData]);
    }

    public function update(UpdatePeriodConfigurationRequest $request, Period $period)
    {
        $period->criteria()->sync($request->validated('criteria', []));
        $period->alternatives()->sync($request->validated('alternatives', []));

        return redirect()->route('admin.periods.index')->with('success', 'Konfigurasi periode berhasil diperbarui.');
    }
}

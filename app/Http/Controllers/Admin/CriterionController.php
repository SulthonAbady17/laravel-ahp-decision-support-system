<?php

namespace App\Http\Controllers\Admin;

use App\Data\Criterion\CriterionViewData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCriterionRequest;
use App\Http\Requests\Admin\UpdateCriterionRequest;
use App\Models\Criterion;
use App\Repositories\CriterionRepository;

class CriterionController extends Controller
{
    public function __construct(
        private readonly CriterionRepository $criterionRepository
    ) {}

    public function index()
    {
        $criteria = $this->criterionRepository->getAllForIndex();

        return view('admin.criteria.index', compact('criteria'));
    }

    public function create()
    {
        return view('admin.criteria.create');
    }

    public function store(StoreCriterionRequest $request)
    {
        $this->criterionRepository->create($request->toDto());

        return redirect()->route('admin.criteria.index')->with('success', 'Kriteria baru berhasil ditambahkan.');
    }

    public function edit(Criterion $criterion)
    {
        $criterionData = CriterionViewData::fromModel($criterion);

        return view('admin.criteria.edit', ['criterion' => $criterionData]);
    }

    public function update(UpdateCriterionRequest $request, Criterion $criterion)
    {
        $this->criterionRepository->update($criterion, $request->toDto());

        return redirect()->route('admin.criteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy(Criterion $criterion)
    {
        $this->criterionRepository->delete($criterion);

        return redirect()->route('admin.criteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}

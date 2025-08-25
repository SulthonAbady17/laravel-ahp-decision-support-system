<?php

namespace App\Http\Controllers\Admin;

use App\Data\Period\PeriodEditData;
use App\Data\Period\PeriodViewData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePeriodRequest;
use App\Http\Requests\Admin\UpdatePeriodRequest;
use App\Models\Period;
use App\Repositories\PeriodRepository;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function __construct(
        private readonly PeriodRepository $periodRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periods = $this->periodRepository->getAllForIndex();

        return view('admin.periods.index', compact('periods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.periods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePeriodRequest $request)
    {
        $this->periodRepository->create($request->toDto());

        return redirect()->route('admin.periods.index')->with('success', 'Periode baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Period $period)
    {
        $periodData = PeriodEditData::fromModel($period);

        // dd($periodData);

        return view('admin.periods.edit', ['period' => $periodData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePeriodRequest $request, Period $period)
    {
        $this->periodRepository->update($period, $request->toDto());

        return redirect()->route('admin.periods.index')->with('success', 'Periode berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Period $period)
    {
        $this->periodRepository->delete($period);

        return redirect()->route('admin.periods.index')->with('success', 'Periode berhasil dihapus.');
    }
}

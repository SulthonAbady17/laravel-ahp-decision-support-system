<?php

namespace App\Http\Controllers\Admin;

use App\Data\Alternative\AlternativeViewData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAlternativeRequest;
use App\Http\Requests\Admin\UpdateAlternativeRequest;
use App\Models\Alternative;
use App\Repositories\AlternativeRepository;

class AlternativeController extends Controller
{
    public function __construct(
        private readonly AlternativeRepository $alternativeRepository
    ) {}

    /**
     * Menampilkan daftar semua alternatif.
     */
    public function index()
    {
        $alternatives = $this->alternativeRepository->getAllForIndex();

        return view('admin.alternatives.index', ['alternatives' => $alternatives]);
    }

    /**
     * Menampilkan form untuk membuat alternatif baru.
     */
    public function create()
    {
        return view('admin.alternatives.create');
    }

    /**
     * Menyimpan alternatif baru ke database.
     */
    public function store(StoreAlternativeRequest $request)
    {
        $this->alternativeRepository->create($request->toDto());

        return redirect()->route('admin.alternatives.index')->with('success', 'Alternatif baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit alternatif.
     */
    public function edit(Alternative $alternative)
    {
        $alternativeData = AlternativeViewData::fromModel($alternative);

        return view('admin.alternatives.edit', ['alternative' => $alternativeData]);
    }

    /**
     * Memperbarui alternatif yang ada di database.
     */
    public function update(UpdateAlternativeRequest $request, Alternative $alternative)
    {
        $this->alternativeRepository->update($alternative, $request->toDto());

        return redirect()->route('admin.alternatives.index')->with('success', 'Alternatif berhasil diperbarui.');
    }

    /**
     * Menghapus alternatif dari database.
     */
    public function destroy(Alternative $alternative)
    {
        $this->alternativeRepository->delete($alternative);

        return redirect()->route('admin.alternatives.index')->with('success', 'Alternatif berhasil dihapus.');
    }
}

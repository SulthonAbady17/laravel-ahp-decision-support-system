<?php

namespace App\Repositories;

use App\Data\Alternative\AlternativeCreateData;
use App\Data\Alternative\AlternativeDropdownData; // <-- Import DTO dropdown
use App\Data\Alternative\AlternativeUpdateData;
use App\Data\Alternative\AlternativeViewData;
use App\Models\Alternative;
use Illuminate\Support\Collection;

class AlternativeRepository
{
    /**
     * Mengambil semua data alternatif untuk halaman index.
     */
    public function getAllForIndex(): Collection
    {
        $alternatives = Alternative::select('id', 'name', 'details')->get();

        return $alternatives->map(fn (Alternative $alt) => AlternativeViewData::fromModel($alt));
    }

    /**
     * Mengambil data minimal (ID dan Nama) untuk mengisi dropdown.
     */
    public function getAllForDropdown(): Collection
    {
        $alternatives = Alternative::select('id', 'name')->get();

        return $alternatives->map(fn (Alternative $alt) => AlternativeDropdownData::fromModel($alt));
    }

    /**
     * Membuat data alternatif baru.
     */
    public function create(AlternativeCreateData $data): Alternative
    {
        return Alternative::create([
            'name' => $data->name,
            'details' => $data->details,
        ]);
    }

    /**
     * Memperbarui data alternatif yang ada.
     */
    public function update(Alternative $alternative, AlternativeUpdateData $data): bool
    {
        return $alternative->update([
            'name' => $data->name,
            'details' => $data->details,
        ]);
    }

    /**
     * Menghapus data alternatif.
     */
    public function delete(Alternative $alternative): bool
    {
        return $alternative->delete();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use Illuminate\Http\Request;

class PeriodConfigurationController extends Controller
{
    public function edit(Period $period)
    {
        // TODO: Ambil semua kriteria & alternatif, lalu tampilkan view
        // return view('admin.periods.configure', ...);
    }

    public function update(Request $request, Period $period)
    {
        // TODO: Validasi data dan simpan relasi menggunakan sync()
        // return redirect()->route(...);
    }
}

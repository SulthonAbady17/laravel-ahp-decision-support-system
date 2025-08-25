<?php

namespace App\Http\Controllers\Admin;

use App\Data\Admin\DashboardData;
use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Criterion;
use App\Models\Period;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboardData = new DashboardData(
            criteriaCount: Criterion::count(),
            alternativesCount: Alternative::count(),
            periodsCount: Period::count()
        );

        return view('admin.dashboard', compact('dashboardData'));
    }
}

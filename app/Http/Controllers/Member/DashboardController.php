<?php

namespace App\Http\Controllers\Member;

use App\Data\Member\DashboardData;
use App\Data\Period\PeriodViewData;
use App\Http\Controllers\Controller;
use App\Models\Period;

class DashboardController extends Controller
{
    public function index()
    {
        $activePeriodModel = Period::where('status', 'active')->first();

        $dashboardData = new DashboardData(
            activePeriod: $activePeriodModel ? PeriodViewData::fromModel($activePeriodModel) : null,
        );

        return view('member.dashboard', ['data' => $dashboardData]);
    }
}

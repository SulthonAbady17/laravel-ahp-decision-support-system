<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Repositories\ResultRepository;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct(
        private readonly ResultRepository $resultRepository
    ) {}

    public function index()
    {
        $latestCompletedPeriod = Period::where('status', 'completed')->latest()->first();

        if (!$latestCompletedPeriod) {
            return view('member.results', ['period' => null, 'results' => collect()]);
        }

        $results = $this->resultRepository->getResultsForPeriod($latestCompletedPeriod->id);

        return view('member.results', ['period' => $latestCompletedPeriod, 'results' => $results]);
    }
}

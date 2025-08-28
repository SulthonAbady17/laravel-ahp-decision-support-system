<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Repositories\ResultRepository;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function __construct(
        private readonly ResultRepository $resultRepository
    ) {}

    public function index(Period $period)
    {
        $results = $this->resultRepository->getResultsForPeriod($period->id);

        return view('admin.results', compact('period', 'results'));
    }
}

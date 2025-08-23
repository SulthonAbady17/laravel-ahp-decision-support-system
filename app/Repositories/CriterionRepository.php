<?php

namespace App\Repositories;

class CriterionRepository
{
    public function getAllForIndex()
    {
        $criteria = Criterion::select('id', 'name', 'description')->get();
    }
}

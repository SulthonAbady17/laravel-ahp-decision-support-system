<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Period extends Model
{
    use HasFactory;

    protected $table = 'selection_periods';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'status',
    ];

    public function criteria(): BelongsToMany
    {
        return $this->belongsToMany(Criterion::class, 'period_criterion', 'selection_period_id', 'criterion_id');
    }

    public function alternatives(): BelongsToMany
    {
        return $this->belongsToMany(Alternative::class, 'period_alternative', 'selection_period_id', 'alternative_id');
    }
}

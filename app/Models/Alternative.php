<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Alternative extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'details',
    ];

    public function periods(): BelongsToMany
    {
        return $this->belongsToMany(Period::class, 'period_alternative', 'alternative_id', 'selection_period_id');
    }
}

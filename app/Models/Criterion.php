<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Criterion extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function periods(): BelongsToMany
    {
        return $this->belongsToMany(Period::class, 'period_criterion');
    }
}

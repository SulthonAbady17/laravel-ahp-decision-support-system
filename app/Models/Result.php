<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'period_id',
        'alternative_id',
        'score',
        'rank',
    ];

    public function alternative(): BelongsTo
    {
        return $this->belongsTo(Alternative::class);
    }
}

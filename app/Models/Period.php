<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    // protected $casts = [
    //     'start_date' => 'date',
    //     'end_date' => 'date',
    // ];
}

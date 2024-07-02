<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'temperature',
        'nausea_level',
        'fatigue_level',
        'pain_level',
        'appetite_level',
        'numbness_level',
        'anxiety_level',
        'memo',
    ];
}

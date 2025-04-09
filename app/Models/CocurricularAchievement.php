<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CocurricularAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_title',
        'category',
        'placement_type',
        'student_count',
        'event_date',
        'description',
    ];

    protected $casts = [
        'event_date' => 'date',
        'student_count' => 'integer',
    ];
}
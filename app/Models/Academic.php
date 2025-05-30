<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Academic extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_name',
        'description',
        'level',
        'curriculum',
        'duration',
        'career_prospects',
        'requirements',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }
}

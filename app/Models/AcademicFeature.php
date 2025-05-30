<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'color',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope: Active features only
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope: Ordered features
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    // Get active features in order
    public static function getActiveFeatures()
    {
        return static::active()->ordered()->get();
    }
}

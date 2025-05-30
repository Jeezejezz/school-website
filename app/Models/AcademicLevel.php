<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'color',
        'sort_order',
        'is_visible'
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    // Scope: Visible levels only
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    // Scope: Ordered levels
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    // Get visible levels in order
    public static function getVisibleLevels()
    {
        return static::visible()->ordered()->get();
    }

    // Get all levels for admin
    public static function getAllLevels()
    {
        return static::ordered()->get();
    }

    // Relationship: Academic programs
    public function academics()
    {
        return $this->hasMany(Academic::class, 'level', 'name');
    }
}

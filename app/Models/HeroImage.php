<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'title',
        'description',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    /**
     * Get active hero images ordered by sort_order
     */
    public static function getActiveImages()
    {
        return self::where('is_active', true)
                   ->orderBy('sort_order')
                   ->orderBy('created_at')
                   ->get();
    }

    /**
     * Get all hero images ordered by sort_order
     */
    public static function getAllImages()
    {
        return self::orderBy('sort_order')
                   ->orderBy('created_at')
                   ->get();
    }

    /**
     * Get next sort order
     */
    public static function getNextSortOrder()
    {
        $maxOrder = self::max('sort_order');
        return $maxOrder ? $maxOrder + 1 : 1;
    }
}

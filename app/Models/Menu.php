<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'route_name',
        'icon',
        'parent_id',
        'sort_order',
        'is_active',
        'open_new_tab',
        'css_class'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'open_new_tab' => 'boolean',
    ];

    // Relationship: Parent menu
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // Relationship: Child menus
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('sort_order');
    }

    // Scope: Active menus only
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope: Main menus (no parent)
    public function scopeMain($query)
    {
        return $query->whereNull('parent_id');
    }

    // Get menu URL
    public function getUrlAttribute($value)
    {
        if ($this->route_name) {
            try {
                return route($this->route_name);
            } catch (\Exception $e) {
                return $value ?: '#';
            }
        }

        return $value ?: '#';
    }

    // Check if menu has children
    public function hasChildren()
    {
        return $this->children()->active()->count() > 0;
    }

    // Get hierarchical menu structure
    public static function getMenuTree()
    {
        return static::active()
            ->main()
            ->with(['children' => function($query) {
                $query->active()->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();
    }
}

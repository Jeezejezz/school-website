<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'vision',
        'mission',
        'history',
        'address',
        'phone',
        'email',
        'website',
        'logo',
        'established_year'
    ];

    protected $casts = [
        'established_year' => 'integer'
    ];
}

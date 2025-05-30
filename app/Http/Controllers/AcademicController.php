<?php

namespace App\Http\Controllers;

use App\Models\Academic;

class AcademicController extends Controller
{
    public function index()
    {
        $academics = Academic::active()->get();
        $academicFeatures = \App\Models\AcademicFeature::getActiveFeatures();
        $academicLevels = \App\Models\AcademicLevel::getVisibleLevels();

        // Get only levels that have visible academic programs
        $levels = $academicLevels->filter(function($level) use ($academics) {
            return $academics->where('level', $level->name)->count() > 0;
        });

        return view('academics', compact('academics', 'levels', 'academicFeatures', 'academicLevels'));
    }

    public function show($id)
    {
        $academic = Academic::findOrFail($id);

        return view('academic-detail', compact('academic'));
    }
}

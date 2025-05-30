<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Homepage;

class AboutController extends Controller
{
    public function index()
    {
        $school = School::first();
        $homepage = Homepage::getSettings();

        return view('about', compact('school', 'homepage'));
    }
}

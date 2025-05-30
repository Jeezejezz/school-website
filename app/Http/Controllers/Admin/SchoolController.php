<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    public function index()
    {
        $school = School::first();
        return view('admin.school.index', compact('school'));
    }

    public function edit()
    {
        $school = School::first();
        if (!$school) {
            $school = new School();
        }
        return view('admin.school.edit', compact('school'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'history' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'established_year' => 'required|integer|min:1900|max:' . date('Y'),
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $school = School::first();

        if (!$school) {
            $school = new School();
        }

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('school', 'public');
            $data['logo'] = $logoPath;
        }

        if ($school->exists) {
            $school->update($data);
        } else {
            School::create($data);
        }

        return redirect()->route('admin.school.index')->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}

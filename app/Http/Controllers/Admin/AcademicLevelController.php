<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicLevel;

class AcademicLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = AcademicLevel::ordered()->get();
        return view('admin.academic-levels.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.academic-levels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:10|unique:academic_levels,name',
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'required|string|in:primary,secondary,success,danger,warning,info,light,dark',
            'sort_order' => 'required|integer|min:0',
            'is_visible' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_visible'] = $request->has('is_visible');

        AcademicLevel::create($data);

        return redirect()->route('admin.academic-levels.index')->with('success', 'Jenjang akademik berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicLevel $academicLevel)
    {
        $academicLevel->load('academics');
        return view('admin.academic-levels.show', compact('academicLevel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicLevel $academicLevel)
    {
        return view('admin.academic-levels.edit', compact('academicLevel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicLevel $academicLevel)
    {
        $request->validate([
            'name' => 'required|string|max:10|unique:academic_levels,name,' . $academicLevel->id,
            'display_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'required|string|in:primary,secondary,success,danger,warning,info,light,dark',
            'sort_order' => 'required|integer|min:0',
            'is_visible' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_visible'] = $request->has('is_visible');

        $academicLevel->update($data);

        return redirect()->route('admin.academic-levels.index')->with('success', 'Jenjang akademik berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicLevel $academicLevel)
    {
        // Check if level has academic programs
        if ($academicLevel->academics()->count() > 0) {
            return redirect()->route('admin.academic-levels.index')
                ->with('error', 'Jenjang tidak dapat dihapus karena masih memiliki program akademik!');
        }

        $academicLevel->delete();

        return redirect()->route('admin.academic-levels.index')->with('success', 'Jenjang akademik berhasil dihapus!');
    }

    /**
     * Toggle visibility of academic level
     */
    public function toggleVisibility(AcademicLevel $academicLevel)
    {
        $academicLevel->update(['is_visible' => !$academicLevel->is_visible]);

        $status = $academicLevel->is_visible ? 'ditampilkan' : 'disembunyikan';
        return redirect()->route('admin.academic-levels.index')
            ->with('success', "Jenjang {$academicLevel->display_name} berhasil {$status}!");
    }
}

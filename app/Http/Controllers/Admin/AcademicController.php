<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Academic;

class AcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academics = Academic::latest()->paginate(10);
        return view('admin.academics.index', compact('academics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.academics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_name' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string|max:100',
            'curriculum' => 'required|string',
            'duration' => 'required|string|max:100',
            'career_prospects' => 'nullable|string',
            'requirements' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        Academic::create($data);

        return redirect()->route('admin.academics.index')->with('success', 'Program akademik berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Academic $academic)
    {
        return view('admin.academics.show', compact('academic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Academic $academic)
    {
        return view('admin.academics.edit', compact('academic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Academic $academic)
    {
        $request->validate([
            'program_name' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string|max:100',
            'curriculum' => 'required|string',
            'duration' => 'required|string|max:100',
            'career_prospects' => 'nullable|string',
            'requirements' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $academic->update($data);

        return redirect()->route('admin.academics.index')->with('success', 'Program akademik berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academic $academic)
    {
        $academic->delete();

        return redirect()->route('admin.academics.index')->with('success', 'Program akademik berhasil dihapus!');
    }
}

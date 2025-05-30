<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicFeature;

class AcademicFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = AcademicFeature::ordered()->paginate(10);
        return view('admin.academic-features.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.academic-features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:255',
            'color' => 'required|string|in:primary,secondary,success,danger,warning,info,light,dark',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        AcademicFeature::create($data);

        return redirect()->route('admin.academic-features.index')->with('success', 'Keunggulan akademik berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicFeature $academicFeature)
    {
        return view('admin.academic-features.show', compact('academicFeature'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicFeature $academicFeature)
    {
        return view('admin.academic-features.edit', compact('academicFeature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AcademicFeature $academicFeature)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'required|string|max:255',
            'color' => 'required|string|in:primary,secondary,success,danger,warning,info,light,dark',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $academicFeature->update($data);

        return redirect()->route('admin.academic-features.index')->with('success', 'Keunggulan akademik berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicFeature $academicFeature)
    {
        $academicFeature->delete();

        return redirect()->route('admin.academic-features.index')->with('success', 'Keunggulan akademik berhasil dihapus!');
    }

    /**
     * Update feature order via AJAX
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'features' => 'required|array',
            'features.*.id' => 'required|exists:academic_features,id',
            'features.*.sort_order' => 'required|integer|min:0'
        ]);

        foreach ($request->features as $featureData) {
            AcademicFeature::where('id', $featureData['id'])
                ->update(['sort_order' => $featureData['sort_order']]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan keunggulan berhasil diperbarui!']);
    }
}

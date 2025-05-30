<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean'
        ]);

        $data = $request->except('image');
        $data['is_featured'] = $request->has('is_featured');

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('gallery', $filename, 'public');
            $data['image_path'] = $path;
        }

        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto berhasil ditambahkan ke gallery!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean'
        ]);

        $data = $request->except('image');
        $data['is_featured'] = $request->has('is_featured');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }

            $image = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('gallery', $filename, 'public');
            $data['image_path'] = $path;
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto gallery berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Delete image file
        if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Foto gallery berhasil dihapus!');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Gallery $gallery)
    {
        $gallery->update(['is_featured' => !$gallery->is_featured]);

        $status = $gallery->is_featured ? 'ditampilkan sebagai unggulan' : 'dihapus dari unggulan';
        return redirect()->route('admin.galleries.index')
            ->with('success', "Foto {$gallery->title} berhasil {$status}!");
    }
}

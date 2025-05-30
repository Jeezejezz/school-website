<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeroImageController extends Controller
{
    /**
     * Display hero images management
     */
    public function index()
    {
        $heroImages = HeroImage::getAllImages();
        return view('admin.hero-images.index', compact('heroImages'));
    }

    /**
     * Show form for creating new hero image
     */
    public function create()
    {
        $imageCount = HeroImage::count();

        if ($imageCount >= 5) {
            return redirect()->route('admin.hero-images.index')
                           ->with('error', 'Maksimal 5 gambar hero yang diizinkan!');
        }

        return view('admin.hero-images.create');
    }

    /**
     * Store new hero image
     */
    public function store(Request $request)
    {
        $imageCount = HeroImage::count();

        if ($imageCount >= 5) {
            return redirect()->route('admin.hero-images.index')
                           ->with('error', 'Maksimal 5 gambar hero yang diizinkan!');
        }

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $data = $request->except(['image']);
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = HeroImage::getNextSortOrder();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'hero_' . time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('hero-images', $filename, 'public');
            $data['image_path'] = $path;
        }

        HeroImage::create($data);

        return redirect()->route('admin.hero-images.index')
                       ->with('success', 'Gambar hero berhasil ditambahkan!');
    }

    /**
     * Show form for editing hero image
     */
    public function edit(HeroImage $heroImage)
    {
        return view('admin.hero-images.edit', compact('heroImage'));
    }

    /**
     * Update hero image
     */
    public function update(Request $request, HeroImage $heroImage)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $data = $request->except(['image']);
        $data['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($heroImage->image_path && Storage::disk('public')->exists($heroImage->image_path)) {
                Storage::disk('public')->delete($heroImage->image_path);
            }

            $image = $request->file('image');
            $filename = 'hero_' . time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('hero-images', $filename, 'public');
            $data['image_path'] = $path;
        }

        $heroImage->update($data);

        return redirect()->route('admin.hero-images.index')
                       ->with('success', 'Gambar hero berhasil diperbarui!');
    }

    /**
     * Delete hero image
     */
    public function destroy(HeroImage $heroImage)
    {
        // Delete image file
        if ($heroImage->image_path && Storage::disk('public')->exists($heroImage->image_path)) {
            Storage::disk('public')->delete($heroImage->image_path);
        }

        $heroImage->delete();

        return redirect()->route('admin.hero-images.index')
                       ->with('success', 'Gambar hero berhasil dihapus!');
    }

    /**
     * Update sort order
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'orders' => 'required|array',
            'orders.*' => 'integer|exists:hero_images,id'
        ]);

        foreach ($request->orders as $index => $id) {
            HeroImage::where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Toggle active status
     */
    public function toggleActive(HeroImage $heroImage)
    {
        $heroImage->update(['is_active' => !$heroImage->is_active]);

        $status = $heroImage->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('admin.hero-images.index')
                       ->with('success', "Gambar hero berhasil {$status}!");
    }
}

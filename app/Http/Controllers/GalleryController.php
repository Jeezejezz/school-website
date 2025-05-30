<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        $galleries = Gallery::when($category, function($query) use ($category) {
            return $query->byCategory($category);
        })->latest()->paginate(12);

        $categories = Gallery::distinct()->pluck('category');

        return view('gallery', compact('galleries', 'categories', 'category'));
    }

    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('gallery-detail', compact('gallery'));
    }
}

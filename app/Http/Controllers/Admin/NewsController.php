<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'published_at' => 'required|date',
            'is_published' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
            $data['image'] = $imagePath;
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'published_at' => 'required|date',
            'is_published' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }

            $imagePath = $request->file('image')->store('news', 'public');
            $data['image'] = $imagePath;
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        // Delete image if exists
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus!');
    }
}

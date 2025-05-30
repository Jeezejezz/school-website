<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with('parent', 'children')
            ->orderBy('sort_order')
            ->get();

        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentMenus = Menu::whereNull('parent_id')->orderBy('sort_order')->get();
        return view('admin.menus.create', compact('parentMenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'route_name' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'open_new_tab' => 'boolean',
            'css_class' => 'nullable|string|max:255'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['open_new_tab'] = $request->has('open_new_tab');

        Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $parentMenus = Menu::whereNull('parent_id')
            ->where('id', '!=', $menu->id)
            ->orderBy('sort_order')
            ->get();

        return view('admin.menus.edit', compact('menu', 'parentMenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'route_name' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'open_new_tab' => 'boolean',
            'css_class' => 'nullable|string|max:255'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['open_new_tab'] = $request->has('open_new_tab');

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        // Check if menu has children
        if ($menu->children()->count() > 0) {
            return redirect()->route('admin.menus.index')
                ->with('error', 'Menu tidak dapat dihapus karena memiliki sub-menu!');
        }

        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus!');
    }

    /**
     * Update menu order via AJAX
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'menus' => 'required|array',
            'menus.*.id' => 'required|exists:menus,id',
            'menus.*.sort_order' => 'required|integer|min:0'
        ]);

        foreach ($request->menus as $menuData) {
            Menu::where('id', $menuData['id'])
                ->update(['sort_order' => $menuData['sort_order']]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan menu berhasil diperbarui!']);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Cache\Store;
use App\Http\Requests\StoreMenuRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::latest()->select(['uuid', 'user_id', 'category_id', 'name', 'slug', 'description', 'price', 'image', 'status'])->paginate(5);

        return view('backend.menu.index', [
            'menus' => $menus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();

        return view('backend.menu.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $validated = $request->validated();

        try {
            $validated['user_id'] = Auth::user()->id; //ini kalau pake ralasi ke user

            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('images', 'public');
            }

            Menu::create($validated);

            return redirect()->route('panel.menu.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('backend.menu.show', [
            'menu' => $menu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $categories = Category::select('id', 'name')->get();

        return view('backend.menu.edit', [
            'menu' => $menu,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $validated = $request->validated();

        try {
            if ($request->hasFile('image')) {
                if ($menu->image && Storage::disk('public')->exists($menu->image)) {
                    Storage::disk('public')->delete($menu->image);
                }
                $validated['image'] = $request->file('image')->store('images', 'public');
            }

            $menu->update($validated);

            return redirect()->route('panel.menu.index')->with('success', 'Menu berhasil diperbarui.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

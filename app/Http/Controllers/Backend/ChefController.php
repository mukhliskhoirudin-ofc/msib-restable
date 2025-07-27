<?php

namespace App\Http\Controllers\Backend;

use App\Models\Chef;
use App\Http\Requests\ChefRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ChefController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chefs = Chef::latest()
            ->select(['uuid', 'name', 'position', 'description', 'image', 'insta_link', 'linked_link'])
            ->paginate(5);

        return view('backend.chef.index', [
            'chefs' => $chefs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.chef.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChefRequest $request)
    {
        $validated = $request->validated();

        try {
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('images', 'public');
            }

            Chef::create($validated);

            return redirect()->route('panel.chef.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Chef $chef)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chef $chef)
    {
        return view('backend.chef.edit', [
            'chef' => $chef
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChefRequest $request, Chef $chef)
    {
        $validated = $request->validated();

        try {
            if ($request->hasFile('image')) {
                if ($chef->image && Storage::disk('public')->exists($chef->image)) {
                    Storage::disk('public')->delete($chef->image);
                }

                $validated['image'] = $request->file('image')->store('images', 'public');
            }

            $chef->update($validated);

            return redirect()->route('panel.chef.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chef $chef)
    {
        try {
            if ($chef->image && Storage::disk('public')->exists($chef->image)) {
                Storage::disk('public')->delete($chef->image);
            }

            $chef->delete();

            return redirect()->route('panel.chef.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

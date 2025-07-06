<?php

namespace App\Http\Controllers\Backend;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageRequest;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::latest()->select(['name', 'slug', 'description', 'file'])->get();

        return view('backend.image.index', [
            'images' => $images
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.image.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        // Validasi input tanpa FormRequest
        // $request->validate([
        //     'name' => 'required|min:3',
        //     'description' => 'required|min:3',
        //     'file' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        // ]);

        $request->validated();

        try {
            $imagePath = $request->file('file')->store('images', 'public');

            // Simpan data Database
            Image::create([
                'name' => $request->name,
                'description' => $request->description,
                'file' => $imagePath,
            ]);

            return redirect()->route('panel.image.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $err->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::latest()->select(['uuid', 'name', 'slug', 'description', 'file'])->paginate(5);

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
    public function show(Image $image)
    {
        return view('backend.image.show', ['image' => $image]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        return view('backend.image.edit', ['image' => $image]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        $validated = $request->validated();

        try {
            // Jika ada file image baru di-upload
            if ($request->hasFile('file')) {
                // Hapus file lama jika ada dan file-nya benar-benar eksis di storage
                if ($image->file && Storage::disk('public')->exists($image->file)) {
                    Storage::disk('public')->delete($image->file);
                }

                // Simpan file baru
                $imagePath = $request->file('file')->store('images', 'public');
                $validated['file'] = $imagePath;
            }

            // Update ke database
            $image->update($validated);

            return redirect()->route('panel.image.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $err->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        try {
            // Hapus file dari storage jika ada
            if ($image->file && Storage::disk('public')->exists($image->file)) {
                Storage::disk('public')->delete($image->file);
            }

            // Hapus data dari database
            $image->delete();

            return redirect()->route('panel.image.index')->with('success', 'Gambar berhasil dihapus.');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $err->getMessage());
        }
    }
}

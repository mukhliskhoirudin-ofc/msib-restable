<?php

namespace App\Http\Controllers\Backend;

use App\Models\Vidio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VidioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vidios = Vidio::latest()->paginate(8);

        return view('backend.vidio.index', [
            'vidios' => $vidios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.vidio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url'],
        ]);

        Vidio::create($validated);

        return redirect()->route('panel.vidio.index')
            ->with('success', 'Vidio berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vidio $vidio)
    {
        return view('backend.vidio.show', [
            'vidio' => $vidio,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vidio $vidio)
    {
        return view('backend.vidio.edit', [
            'vidio' => $vidio,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vidio $vidio)
    {
        $validated =  $request->validate([
            'title' => ['required', 'string'],
            'url' => ['required', 'url'],
        ]);

        $vidio->update($validated);

        return redirect()->route('panel.vidio.index')
            ->with('success', 'Vidio berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vidio $vidio)
    {
        $vidio->delete();

        return redirect()->route('panel.vidio.index')
            ->with('success', 'Vidio berhasil dihapus.');
    }
}

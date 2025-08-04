<?php

namespace App\Http\Controllers\Backend;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()
            ->select(['uuid', 'name', 'price', 'description', 'image', 'status'])
            ->paginate(5);

        return view('backend.event.index', [
            'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $validated = $request->validated();

        try {
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('images', 'public');
            }

            Event::create($validated);

            return redirect()->route('panel.event.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
    public function edit(Event $event)
    {
        return view('backend.event.edit', [
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        $validated = $request->validated();

        try {
            if ($request->hasFile('image')) {
                if ($event->image && Storage::disk('public')->exists($event->image)) {
                    Storage::disk('public')->delete($event->image);
                }

                $validated['image'] = $request->file('image')->store('images', 'public');
            }

            $event->update($validated);

            return redirect()->route('panel.event.index')->with('success', 'Data berhasil diupdate.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        try {
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            $event->delete();

            return redirect()->route('panel.event.index')->with('success', 'Event berhasil dihapus.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

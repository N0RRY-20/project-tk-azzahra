<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventLomba;
use Illuminate\Http\Request;

class EventLombaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event)
    {
        return view('admin.lomba.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'nama_lomba' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
        ]);

        $event->lomba()->create($validatedData);

        return redirect()->route('admin.events.show', $event)->with('success', 'Jenis lomba baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EventLomba $eventLomba)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventLomba $lomba)
    {
        return view('admin.lomba.edit', compact('lomba'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventLomba $lomba)
    {
        $validatedData = $request->validate([
            'nama_lomba' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'kuota' => 'required|integer|min:1',
        ]);

        $lomba->update($validatedData);
        return redirect()->route('admin.events.show', $lomba->id_event)->with('success', 'Data lomba berhasil diperbarui.');
    }

    public function destroy(EventLomba $lomba)
    {
        $id_event = $lomba->id_event;
        $lomba->delete();
        return redirect()->route('admin.events.show', $id_event)->with('success', 'Jenis lomba berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventLomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranLombaController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_lomba' => 'required|exists:event_lomba,id_lomba',
            'nama_pendaftar' => 'required|string|max:255',
            'status_pendaftar' => 'required|in:Ayah,Bunda',
        ]);

        $lomba = EventLomba::find($validated['id_lomba']);

        // --- TAMBAHKAN PENGECEKAN BARU DI SINI ---
        // Cek apakah user sudah terdaftar di lomba lain dalam event yang sama
        $isAlreadyRegisteredInEvent = Event::where('id_event', $lomba->id_event)
            ->whereHas('lomba.pendaftaran', function ($query) {
                $query->where('id_orangtua', Auth::id());
            })->exists();

        if ($isAlreadyRegisteredInEvent) {
            return back()->with('error', 'Anda sudah terdaftar di lomba lain pada event ini.');
        }
        // --- BATAS PENGECEKAN BARU ---

        // Cek kuota
        if ($lomba->pendaftaran()->count() >= $lomba->kuota) {
            return back()->with('error', 'Maaf, kuota untuk lomba ini sudah penuh.');
        }

        // Simpan pendaftaran
        $lomba->pendaftaran()->create([
            'id_orangtua' => Auth::id(),
            'nama_pendaftar' => $validated['nama_pendaftar'],
            'status_pendaftar' => $validated['status_pendaftar'],
        ]);

        return back()->with('success', 'Anda berhasil terdaftar!');
    }
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'id_lomba' => 'required|exists:event_lomba,id_lomba',
        ]);

        $lomba = EventLomba::find($validated['id_lomba']);
        $lomba->pendaftaran()->where('id_orangtua', Auth::id())->delete();

        return back()->with('success', 'Pendaftaran Anda berhasil dibatalkan.');
    }
}

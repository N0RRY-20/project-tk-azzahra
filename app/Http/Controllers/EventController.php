<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Menampilkan daftar semua event
    public function index()
    {
        $events = Event::where('tanggal_event', '>=', now())->orderBy('tanggal_event')->get();
        return view('events.index', compact('events'));
    }

    // Menampilkan detail satu event beserta lombanya
    public function show(Event $event)
    {
        $event->load('lomba.pendaftaran.orangtua');
        // --- TAMBAHKAN LOGIKA INI ---
        $userHasRegistered = false;
        // Cek hanya jika user login sebagai orang tua
        if (Auth::check() && Auth::user()->peran === 'orangtua') {
            // Cek apakah user ini punya pendaftaran di SALAH SATU lomba dalam event ini
            $userHasRegistered = $event->lomba()->whereHas('pendaftaran', function ($query) {
                $query->where('id_orangtua', Auth::id());
            })->exists();
        }
        // --- BATAS LOGIKA BARU ---
        return view('events.show', compact('event', 'userHasRegistered'));
    }
}

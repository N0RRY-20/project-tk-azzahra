<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function create(Tagihan $tagihan)
    {
        return view('admin.keuangan.pembayaran.create', compact('tagihan'));
    }

    public function store(Request $request, Tagihan $tagihan)
    {
        $validatedData = $request->validate([
            'jumlah_bayar' => 'required|integer|min:1',
            'tanggal_bayar' => 'required|date',
            'metode_bayar' => 'nullable|string',
            'catatan_admin' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validatedData, $tagihan) {
            // 1. Catat pembayaran
            $tagihan->pembayaran()->create([
                'jumlah_bayar' => $validatedData['jumlah_bayar'],
                'tanggal_bayar' => $validatedData['tanggal_bayar'],
                'metode_bayar' => $validatedData['metode_bayar'],
                'catatan_admin' => $validatedData['catatan_admin'],
                'id_admin' => Auth::id(),
            ]);

            // 2. Update status tagihan
            $totalTerbayar = $tagihan->pembayaran()->sum('jumlah_bayar');
            $status = 'Belum Lunas';
            if ($totalTerbayar >= $tagihan->jumlah_tagihan) {
                $status = 'Lunas';
            } elseif ($totalTerbayar > 0) {
                $status = 'Sebagian';
            }
            $tagihan->update(['status' => $status]);
        });

        return redirect()->route('admin.tagihan.show', $tagihan)->with('success', 'Pembayaran berhasil dicatat.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagihanList = Tagihan::with('siswa.kelas')->latest()->get();
        $deskripsiList = Tagihan::select('deskripsi')->distinct()->get();
        return view('admin.keuangan.tagihan.index', compact('tagihanList', 'deskripsiList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua siswa untuk ditampilkan di dropdown
        $siswaList = Siswa::orderBy('nama_lengkap')->get();
        return view('admin.keuangan.tagihan.create', compact('siswaList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'deskripsi' => 'required|string|max:255',
            'jumlah_tagihan' => 'required|integer|min:0',
            'tanggal_jatuh_tempo' => 'required|date',
        ]);

        Tagihan::create($validatedData);
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan baru berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tagihan $tagihan)
    {
        // Eager load relasi siswa dan pembayaran
        $tagihan->load(['siswa', 'pembayaran.admin']);
        return view('admin.keuangan.tagihan.show', compact('tagihan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tagihan $tagihan)
    {
        // Ambil semua siswa untuk ditampilkan di dropdown
        $siswaList = Siswa::orderBy('nama_lengkap')->get();
        return view('admin.keuangan.tagihan.edit', compact('tagihan', 'siswaList'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tagihan $tagihan)
    {
        $validatedData = $request->validate([
            'id_siswa' => 'required|exists:siswa,id_siswa',
            'deskripsi' => 'required|string|max:255',
            'jumlah_tagihan' => 'required|integer|min:0',
            'tanggal_jatuh_tempo' => 'required|date',
            // Tambahkan validasi untuk status jika diperlukan
            'status' => 'required|string|in:Belum Lunas,Sebagian,Lunas',
        ]);

        $tagihan->update($validatedData);
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tagihan $tagihan)
    {
        // Logika delete...
        $tagihan->delete();
        return redirect()->route('admin.tagihan.index')->with('success', 'Tagihan berhasil dihapus.');
    }

    /**
     * Menampilkan form untuk generate tagihan massal.
     */
    public function createMassal()
    {
        return view('admin.keuangan.tagihan.create_massal');
    }
    public function storeMassal(Request $request)
    {
        $validatedData = $request->validate([
            'deskripsi' => 'required|string|max:255',
            'jumlah_tagihan' => 'required|integer|min:0',
            'tanggal_jatuh_tempo' => 'required|date',
        ]);

        // Ambil semua siswa yang aktif (untuk sekarang kita ambil semua)
        $siswas = Siswa::all();
        $tagihanBaru = [];
        $now = now();

        foreach ($siswas as $siswa) {
            $tagihanBaru[] = [
                'id_siswa' => $siswa->id_siswa,
                'deskripsi' => $validatedData['deskripsi'],
                'jumlah_tagihan' => $validatedData['jumlah_tagihan'],
                'tanggal_jatuh_tempo' => $validatedData['tanggal_jatuh_tempo'],
                'status' => 'Belum Lunas',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Gunakan satu query insert untuk efisiensi
        if (!empty($tagihanBaru)) {
            Tagihan::insert($tagihanBaru);
        }

        return redirect()->route('admin.tagihan.index')
            ->with('success', count($tagihanBaru) . ' tagihan baru berhasil di-generate.');
    }
    public function destroyMassal(Request $request)
    {
        $validated = $request->validate([
            'deskripsi_massal' => 'required|string|exists:tagihan,deskripsi',
        ]);

        $deskripsi = $validated['deskripsi_massal'];

        // PENGAMAN: Hapus semua tagihan yang cocok dengan deskripsi 
        // DAN statusnya masih 'Belum Lunas'
        $jumlahDihapus = Tagihan::where('deskripsi', $deskripsi)
            ->where('status', 'Belum Lunas')
            ->delete();

        if ($jumlahDihapus > 0) {
            return redirect()->route('admin.tagihan.index')->with('success', "$jumlahDihapus tagihan berhasil dihapus secara massal.");
        }

        return redirect()->route('admin.tagihan.index')->with('error', "Tidak ada tagihan 'Belum Lunas' dengan deskripsi tersebut yang bisa dihapus.");
    }
}

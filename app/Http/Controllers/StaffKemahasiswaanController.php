<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPengajuanSurat;
use Illuminate\View\View;
use App\Models\SuratMasuk;
use App\Models\RiwayatSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StaffKemahasiswaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Menghitung jumlah surat masuk
        $totalSuratMasuk = DB::table('surat_masuks')->count();

        // Mengembalikan view dengan data user dan total surat masuk
        return view('staff-kemahasiswaan.index', compact('user', 'totalSuratMasuk'));
    }

    public function surat_masuk(Request $request): View
    {
        $user = Auth::user();
        $surat_masuks = SuratMasuk::all();
        return view('staff-kemahasiswaan.surat-masuk', compact('surat_masuks'));
    }

    public function index1(Request $request)
    {
        $query = SuratMasuk::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_kegiatan', 'like', '%' . $search . '%')
                    ->orWhere('nomor_surat', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan jenis surat
        if ($request->filled('jenis_surat')) {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sorting
        if ($request->filled('sort')) {
            if ($request->sort === 'terbaru') {
                $query->orderBy('tanggal_diajukan', 'desc');
            } elseif ($request->sort === 'terlama') {
                $query->orderBy('tanggal_diajukan', 'asc');
            }
        }

        // Ambil data
        $surat_masuks = $query->get();

        return view('staff-kemahasiswaan.surat-masuk', compact('surat_masuks'));
    }


    public function surat_keluar(Request $request): View
    {
        $user = Auth::user();
        return view('staff-kemahasiswaan.surat-keluar', compact('user'));
    }

    public function riwayat_surat(Request $request): View
    {
        $user = Auth::user();
        return view('riwayat-surat', compact('user'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff-kemahasiswaan.surat-keluar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data dari form
        $validated = $request->validate([
            'tanggal_surat' => 'required|date',
            'nomor_surat' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'file_surat' => 'required|file|mimes:pdf', // File opsional
            'status' => 'nullable|string|max:255',
        ]);

        // Simpan file jika diunggah
        $filePath = null;
        if ($request->hasFile('file_surat')) {
            $filePath = $request->file('file_surat')->store('surat', 'public'); // Simpan di storage/public/surat
        }

        // Simpan data ke tabel surat masuk
        SuratMasuk::create([
            'tanggal_diajukan' => $validated['tanggal_surat'],
            'nomor_surat' => $validated['nomor_surat'],
            'jenis_surat' => $validated['jenis_surat'],
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'penanggung_jawab' => $validated['penanggung_jawab'],
            'file_surat' => $filePath,
            'status' => $validated['status'],
        ]);

        // Simpan data ke tabel surat masuk
        RiwayatSurat::create([
            'nama_oramawa' => Auth::user()->name,
            'tanggal_surat_masuk_keluar' => $validated['tanggal_surat'],
            'nomor_surat' => $validated['nomor_surat'],
            'jenis_surat' => $validated['jenis_surat'],
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'penanggung_jawab' => $validated['penanggung_jawab'],
            'file_surat' => $filePath,
            'status' => $validated['status'],
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('staff-kemahasiswaan.surat-keluar')->with('success', 'Surat keluar berhasil dikirim!');
    }

    // Menyetujuinya surat masuk
    public function setujuiSurat($id)
    {
        // Menemukan surat yang akan disetujui
        $suratMasuk = SuratMasuk::findOrFail($id);
        
        // Menyetujuinya surat
        $suratMasuk->status = 'Disetujui';
        $suratMasuk->save();

        // Mengupdate status di riwayat pengajuan surat
        RiwayatPengajuanSurat::where('surat_masuk_id', $suratMasuk->id)
            ->update(['status' => 'Disetujui']);

        return redirect()->route('riwayat-surat')->with('success', 'Surat disetujui');
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

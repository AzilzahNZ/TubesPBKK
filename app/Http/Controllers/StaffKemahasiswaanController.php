<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\RiwayatSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RiwayatPengajuanSurat;
use Illuminate\Support\Facades\Log;

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
        $totalSuratMasuk = DB::table('surat_masuks')->where('status', 'Diproses')->count();
        $totalSuratDisetujui = DB::table('riwayat_surats')->where('status', 'Disetujui')->count();
        $totalSuratDitolak = DB::table('riwayat_surats')->where('status', 'Ditolak')->count();
        $totalSuratKeluar = DB::table('surat_keluars')->count();

        // Mengembalikan view dengan data user dan total surat masuk
        return view('staff-kemahasiswaan.index', compact('user', 'totalSuratMasuk', 'totalSuratDisetujui', 'totalSuratDitolak', 'totalSuratKeluar'));
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
        // Validasi umum untuk semua jenis surat
        $request->validate([
            'tanggal_diajukan' => 'required|date',
            'nomor_surat' => 'required|string',
            'jenis_surat' => 'required|string',
            'nama_kegiatan' => 'required|string',
            'penanggung_jawab' => 'required|string',
            'file_surat' => 'required|file|mimes:pdf',
        ]);

        // Simpan data ke tabel surat_keluar
        $suratKeluar = new SuratKeluar;
        $suratKeluar->user_id = Auth::user()->id; // ID Ormawa berdasarkan akun yang login
        $suratKeluar->tanggal_diajukan = $request->tanggal_diajukan;
        $suratKeluar->nomor_surat = $request->nomor_surat;
        $suratKeluar->jenis_surat = $request->jenis_surat;
        $suratKeluar->nama_kegiatan = $request->nama_kegiatan;
        $suratKeluar->penanggung_jawab = $request->penanggung_jawab;
        $suratKeluar->file_surat = $request->file('file_surat')->store('surat', 'public');
        $suratKeluar->nominal_dana = $request->nominal_dana ?? null;
        $suratKeluar->tanggal_diedit = null;
        $suratKeluar->save();

        RiwayatSurat::create([
            'surat_masuk_id' => null,
            'nama_ormawa' => $suratKeluar->user->name,
            'tanggal_surat_masuk_keluar' => now(),
            'kategori' => 'Surat Keluar',
            'nomor_surat' => $suratKeluar->nomor_surat,
            'jenis_surat' => $suratKeluar->jenis_surat,
            'nama_kegiatan' => $suratKeluar->nama_kegiatan,
            'penanggung_jawab' => $suratKeluar->penanggung_jawab,
            'file_surat' => $suratKeluar->file_surat,
            'status' => 'Selesai',
        ]);

        // Siapkan data untuk riwayat_pengajuan_surat
        // $data = [
        //     'surat_masuk_id' => $suratKeluar->id,
        //     'nama_ormawa' => $suratKeluar->user->name,
        //     'tanggal_surat_masuk_keluar' => $suratKeluar->tanggal_diajukan,
        //     'kategori' => 'Surat Keluar',
        //     'nomor_surat' => $suratKeluar->nomor_surat,
        //     'jenis_surat' => $suratKeluar->jenis_surat,
        //     'nama_kegiatan' => $suratKeluar->nama_kegiatan,
        //     'penanggung_jawab' => $suratKeluar->penanggung_jawab,
        //     'file_surat' => $suratKeluar->file_surat,
        //     'status' => 'Selesai',
        // ];


        // // Jika jenis surat adalah Proposal Permohonan Dana, tambahkan nominal dana
        // if ($request->jenis_surat === 'Proposal Permohonan Dana') {
        //     $data['nominal_dana'] = $request->nominal_dana;
        // }

        // // Simpan data ke tabel riwayat_pengajuan_surat
        // RiwayatSurat::create($data);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Surat keluar berhasil diajukan!');
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

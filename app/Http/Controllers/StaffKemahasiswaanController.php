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
use Illuminate\Support\Facades\Http;
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
        $totalSuratMasuk = DB::table('surat_masuks')->where('status', 'Diproses')
            ->orWhere('status', 'Direvisi')
            ->count();
        $totalSuratDisetujui = DB::table('riwayat_surats')->where('status', 'Disetujui')->count();
        $totalSuratDitolak = DB::table('riwayat_surats')->where('status', 'Ditolak')->count();
        $totalSuratKeluar = DB::table('riwayat_surats')->where('status', 'Selesai')->count();

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
        $surat_masuks = SuratMasuk::all();;
        // $surat_masuks = $query->get();

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
            'nominal_dana' => 'nullable|numeric|min:1',
        ]);

        // Simpan file surat dan dapatkan path-nya
        $filePath = $request->file('file_surat')->store('surat', 'public');

        // Simpan data langsung ke tabel RiwayatSurat
        $riwayatSurat = RiwayatSurat::create([
            'surat_masuk_id' => null,
            'nama_ormawa' => Auth::user()->name, // Nama Ormawa berdasarkan akun yang login
            'tanggal_surat_masuk_keluar' => now(),
            'kategori' => 'Surat Keluar',
            'nomor_surat' => $request->nomor_surat,
            'jenis_surat' => $request->jenis_surat,
            'nama_kegiatan' => $request->nama_kegiatan,
            'penanggung_jawab' => $request->penanggung_jawab,
            'file_surat' => $filePath,
            'status' => 'Selesai',
            'nominal_dana_disetujui' => $request->nominal_dana ?? null,
        ]);

        // // Kirim pesan WhatsApp menggunakan Fonnte
        // $nomorTelepon = Auth::user()->no_telepon; // Ambil nomor telepon dari pengguna yang sedang login

        // try {
        //     if (!$nomorTelepon) {
        //         Log::warning('Nomor telepon tidak ditemukan.');
        //         return redirect()->back()->with('error', 'Nomor telepon pengguna tidak ditemukan!');
        //     }

        //     $response = Http::withHeaders([
        //         'Authorization' => '1gDkUvyVMXaej64QEsrZ', // Ganti dengan API Key Fonnte Anda
        //     ])->post('https://api.fonnte.com/send', [
        //         'target' => $nomorTelepon, // Nomor WhatsApp tujuan
        //         'message' => "Hai, ini SIMPULS. Surat sudah selesai dan bisa diambil di Loket Kemahasiswaan:\n\n" .
        //             "Nomor Surat: {$riwayatSurat->nomor_surat}\n" .
        //             "Jenis Surat: {$riwayatSurat->jenis_surat}\n" .
        //             "Nama Kegiatan: {$riwayatSurat->nama_kegiatan}.",
        //     ]);

        //     if ($response->successful()) {
        //         Log::info('Pesan WhatsApp berhasil dikirim.');
        //     } else {
        //         Log::warning('Pesan WhatsApp gagal dikirim: ' . $response->body());
        //     }
        // } catch (\Exception $e) {
        //     Log::error('Terjadi kesalahan saat mengirim pesan WhatsApp: ' . $e->getMessage());
        // }

        return redirect()->route('riwayat-surat')->with('success', 'Surat keluar berhasil dibuat dan notifikasi WhatsApp dikirim!');
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

<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPengajuanSurat;
use App\Models\SuratMasuk;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrmawaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        // Ambil riwayat pengajuan surat sesuai dengan user_id pengguna login
        $riwayat_pengajuan_surats = RiwayatPengajuanSurat::where('user_id', $user->id)->get();

        // Hitung total status berdasarkan user_id pengguna login
        $totalStatusDiproses = DB::table('riwayat_pengajuan_surats')
            ->where('user_id', $user->id)
            ->where('status', 'Diproses')
            ->count();

        $totalStatusDisetujui = DB::table('riwayat_pengajuan_surats')
            ->where('user_id', $user->id)
            ->where('status', 'Disetujui')
            ->count();

        $totalStatusDitolak = DB::table('riwayat_pengajuan_surats')
            ->where('user_id', $user->id)
            ->where('status', 'Ditolak')
            ->count();

        $totalStatusSelesai = DB::table('riwayat_pengajuan_surats')
            ->where('user_id', $user->id)
            ->where('status', 'Selesai')
            ->count();

        return view('ormawa.index', compact('user', 'riwayat_pengajuan_surats', 'totalStatusDiproses', 'totalStatusDisetujui', 'totalStatusDitolak', 'totalStatusSelesai'));
    }

    public function pengajuan_surat(Request $request): View
    {
        $user = Auth::user();
        return view('ormawa.pengajuan-surat', compact('user'));
    }

    public function riwayat_pengajuan_surat(Request $request): View
    {
        $user = Auth::user();

        $riwayat_pengajuan_surats = RiwayatPengajuanSurat::where('user_id', $user->id)->get();
        // dd($riwayat_pengajuan_surats);
        return view('ormawa.riwayat-pengajuan-surat', compact('riwayat_pengajuan_surats'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ormawa.pengajuan-surat');
    }

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

        // Tambahan validasi jika jenis surat adalah Proposal Permohonan Dana
        if ($request->jenis_surat === 'Proposal Permohonan Dana') {
            $request->validate([
                'nominal_dana' => 'required|numeric|min:1',
            ]);
        }

        // Simpan data ke tabel surat_masuk
        $suratMasuk = new SuratMasuk;
        $suratMasuk->user_id = Auth::user()->id; // ID Ormawa berdasarkan akun yang login
        $suratMasuk->tanggal_diajukan = $request->tanggal_diajukan;
        $suratMasuk->nomor_surat = $request->nomor_surat;
        $suratMasuk->jenis_surat = $request->jenis_surat;
        $suratMasuk->nama_kegiatan = $request->nama_kegiatan;
        $suratMasuk->penanggung_jawab = $request->penanggung_jawab;
        $suratMasuk->file_surat = $request->file('file_surat')->store('surat', 'public');
        $suratMasuk->save();

        // Siapkan data untuk riwayat_pengajuan_surat
        $data = [
            'user_id' => Auth::user()->id,
            'surat_masuk_id' => $suratMasuk->id, // Get the actual surat_masuk_id
            'tanggal_diajukan' => $request->tanggal_diajukan,
            'nomor_surat' => $request->nomor_surat,
            'jenis_surat' => $request->jenis_surat,
            'nama_kegiatan' => $request->nama_kegiatan,
            'penanggung_jawab' => $request->penanggung_jawab,
            'file_surat' => $suratMasuk->file_surat('file_surat')->store('surat', 'public'),
            'nominal_dana' => $request->nominal_dana,
            'status' => 'Diproses', // Set the correct status
            'nominal_dana' => $request->nominal_dana, // Ensure this is passed correctly
        ];


        // Jika jenis surat adalah Proposal Permohonan Dana, tambahkan nominal dana
        if ($request->jenis_surat === 'Proposal Permohonan Dana') {
            $data['nominal_dana'] = $request->nominal_dana;
        }

        // Simpan data ke tabel riwayat_pengajuan_surat
        RiwayatPengajuanSurat::create($data);

        // Redirect dengan pesan sukses
        return redirect()->route('ormawa.riwayat-pengajuan-surat')->with('success', 'Pengajuan surat berhasil disimpan!');
    }




    // public function store(Request $request)
    // {
    //     // Validasi umum untuk semua jenis surat
    //     $request->validate([
    //         'tanggal_diajukan' => 'required|date',
    //         'nomor_surat' => 'required|string',
    //         'jenis_surat' => 'required|string',
    //         'nama_kegiatan' => 'required|string',
    //         'penanggung_jawab' => 'required|string',
    //         'file_surat' => 'required|file|mimes:pdf',
    //         'nominal_dana' => 'nullable|numeric|min:1',
    //     ]);

    //     // Tambahan validasi jika jenis surat adalah Proposal Permohonan Dana
    //     if ($request->jenis_surat === 'Proposal Permohonan Dana') {
    //         $request->validate([
    //             'nominal_dana' => 'required|numeric|min:1',
    //         ]);
    //     }

    //     // Menyimpan data ke database (contoh)
    //     $data = [
    //         'user_id' => Auth::id(), // Menambahkan ID pengguna yang sedang login
    //         'tanggal_diajukan' => $request->tanggal_diajukan,
    //         'nomor_surat' => $request->nomor_surat,
    //         'jenis_surat' => $request->jenis_surat,
    //         'nama_kegiatan' => $request->nama_kegiatan,
    //         'penanggung_jawab' => $request->penanggung_jawab,
    //         'file_surat' => $request->file('file_surat')->store('surat', 'public'), // Menyimpan file di folder public/storage/surat
    //         'nominal_dana' => $request->nominal_dana,
    //     ];

    //     // Jika jenis surat adalah Proposal Permohonan Dana, tambahkan nominal dana
    //     if ($request->jenis_surat === 'Proposal Permohonan Dana') {
    //         $data['nominal_dana'] = $request->nominal_dana;
    //     }

    //     // Simpan ke database (contoh dengan model PengajuanSurat)
    //     RiwayatPengajuanSurat::create($data);

    //     // Redirect dengan pesan sukses
    //     return redirect()->route('ormawa.riwayat-pengajuan-surat')->with('success', 'Pengajuan surat berhasil disimpan!');
    // }


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
        $pengajuanSurat = RiwayatPengajuanSurat::findOrFail($id); // Cari data berdasarkan ID pengajuanSurat::findOrFail($id);
        return view('ormawa.edit-pengajuan-surat', compact('pengajuanSurat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal_diajukan' => 'required|date',
            'nomor_surat' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'file_surat' => 'required|file|mimes:pdf',
            'nominal_dana' => 'nullable|numeric|min:1',
            'status' => 'nullable|string|max:255',
        ]);

        // Temukan user berdasarkan ID
        $pengajuanSurat = RiwayatPengajuanSurat::findOrFail($id);

        // Update data pengguna
        $pengajuanSurat->update([
            'tanggal_diajukan' => $request->tanggal_diajukan,
            'nomor_surat' => $request->nomor_surat,
            'jenis_surat' => $request->jenis_surat,
            'nama_kegiatan' => $request->nama_kegiatan,
            'penanggung_jawab' => $request->penanggung_jawab,
            'file_surat' => $request->file('file_surat')->store('surat', 'public'),
            'nominal_dana' => $request->nominal_dana,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $riwayat_pengajuan_surats = RiwayatPengajuanSurat::findOrFail($id); // Cari data berdasarkan ID
        // $riwayat_pengajuan_surats->delete(); // Hapus data

        // return redirect()->back()->with('success', 'Pengajuan surat berhasil dihapus!');

        // Temukan RiwayatPengajuanSurat berdasarkan ID
        $riwayat_pengajuan_surat = RiwayatPengajuanSurat::findOrFail($id);

        // Temukan SuratMasuk terkait dengan RiwayatPengajuanSurat
        $suratMasuk = $riwayat_pengajuan_surat->suratMasuk; // Akses data suratMasuk yang terkait

        // Jika suratMasuk ditemukan, ubah statusnya menjadi 'Dibatalkan'
        if ($suratMasuk) {
            $suratMasuk->update([
                'status' => 'Dibatalkan', // Ubah status surat menjadi 'Dibatalkan'
            ]);
        }

        // Menghapus data di tabel riwayat_pengajuan_surat setelah pembatalan
        $riwayat_pengajuan_surat->delete();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Pengajuan surat dibatalkan dan status surat diubah menjadi "Dibatalkan"!');
    }
}

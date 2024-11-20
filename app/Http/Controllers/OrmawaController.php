<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPengajuanSurat;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrmawaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        return view('ormawa.index', compact('user'));
    }

    public function pengajuan_surat(Request $request): View
    {
        $user = Auth::user();
        return view('ormawa.pengajuan-surat', compact('user'));
    }

    public function riwayat_pengajuan_surat(Request $request): View
    {
        $user = Auth::user();
        
        $riwayat_pengajuan_surats = RiwayatPengajuanSurat::all();
        // dd($riwayat_pengajuan_surats);
        return view('ormawa.riwayat-pengajuan-surat', compact('riwayat_pengajuan_surats'));
    }

    public function index1(Request $request)
    {
        $query = RiwayatPengajuanSurat::query();

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
        $riwayat_pengajuan_surats = $query->get();

        return view('ormawa.riwayat-pengajuan-surat', compact('riwayat_pengajuan_surats'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ormawa.pengajuan-surat');
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
            'file_surat' => 'nullable|file|mimes:pdf|max:2048', // File opsional
        ]);

        // Simpan file jika diunggah
        $filePath = null;
        if ($request->hasFile('file_surat')) {
            $filePath = $request->file('file_surat')->store('surat', 'public'); // Simpan di storage/public/surat
        }

        // Simpan data ke tabel riwayat_pengajuan_surats
        RiwayatPengajuanSurat::create([
            'tanggal_diajukan' => $validated['tanggal_surat'],
            'nomor_surat' => $validated['nomor_surat'],
            'jenis_surat' => $validated['jenis_surat'],
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'penanggung_jawab' => $validated['penanggung_jawab'],
            'file_surat' => $filePath,
            'status' => 'Diproses', // Status default
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('ormawa.riwayat-pengajuan-surat')->with('success', 'Pengajuan surat berhasil disimpan!');
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
        $pengajuan = RiwayatPengajuanSurat::findOrFail($id);

        return response()->json([
            'id' => $pengajuan->id,
            'tanggal_surat' => $pengajuan->tanggal_diajukan,
            'nomor_surat' => $pengajuan->nomor_surat,
            'jenis_surat' => $pengajuan->jenis_surat,
            'nama_kegiatan' => $pengajuan->nama_kegiatan,
            'penanggung_jawab' => $pengajuan->penanggung_jawab,
            'file_surat' => $pengajuan->file_surat,
            'status' => $pengajuan->status,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal_surat' => 'required|date',
            'nomor_surat' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'file_surat' => 'required|file|mimes:pdf|max:2048',
            'status' => 'required|in:Diproses,Selesai',
        ]);

        $pengajuan = RiwayatPengajuanSurat::findOrFail($id);
        $pengajuan->update([
            $pengajuan->tanggal_diajukan = $request->tanggal_surat,
            $pengajuan->nomor_surat = $request->nomor_surat,
            $pengajuan->jenis_surat = $request->jenis_surat,
            $pengajuan->nama_kegiatan = $request->nama_kegiatan,
            $pengajuan->penanggung_jawab = $request->penanggung_jawab,
            $pengajuan->file_surat = $request->file('file_surat')->store('surat', 'public'),
            $pengajuan->status = $request->status,
            $pengajuan->save()
        ]);

        return redirect()->route('ormawa.riwayat-pengajuan-surat')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $riwayat_pengajuan_surats = RiwayatPengajuanSurat::findOrFail($id); // Cari data berdasarkan ID
        $riwayat_pengajuan_surats->delete(); // Hapus data

        return redirect()->back()->with('success', 'Pengajuan surat berhasil dihapus!');
    }
}

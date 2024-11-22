<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    public function index(Request $request)
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
        $riwayat_pengajuan_surats = $query->get();

        return view('staff-kemahasiswaan.surat-masuk', compact('surat_masuks'));
    }

    public function create()
    {
        return view('staff-kemahasiswaan.surat-keluar');
    }

    public function show($id)
    {
        // Fetch data berdasarkan ID
        $surat_masuks = SuratMasuk::findOrFail($id);

        // Return ke view dengan data
        return view('staff-kemahasiswaan.detail-surat', compact('surat_masuks'));
    }
}

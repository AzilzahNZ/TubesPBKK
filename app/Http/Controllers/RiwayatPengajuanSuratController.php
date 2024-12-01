<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPengajuanSurat;
use Illuminate\Http\Request;

class RiwayatPengajuanSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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

    public function detail($id)
    {
        $riwayat_pengajuan_surats = RiwayatPengajuanSurat::findOrFail($id);
        return view('ormawa.detail-riwayat-pengajuan-surat', compact('riwayat_pengajuan_surats'));
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
        //
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

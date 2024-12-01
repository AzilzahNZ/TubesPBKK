<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\RiwayatSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class RiwayatSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = RiwayatSurat::query();

        // Pencarian Global
        if ($request->filled('search')) {
            $search = $request->search;
            $columns = Schema::getColumnListing('riwayat_surats'); // Nama tabel
            $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $search . '%');
                }
            });
        }


        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
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
                $query->orderBy('tanggal_surat_masuk_keluar', 'desc');
            } elseif ($request->sort === 'terlama') {
                $query->orderBy('tanggal_surat_masuk_keluar', 'asc');
            }
        }

        // Ambil data
        $riwayat_surats = $query->get();

        return view('riwayat-surat', compact('riwayat_surats'));
    }

    public function detail($id)
    {
        $riwayat_surats = RiwayatSurat::findOrFail($id);
        return view('detail-riwayat-surat', compact('riwayat_surats'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('staff-kemahasiswaan.pengajuan-surat');
    }
}

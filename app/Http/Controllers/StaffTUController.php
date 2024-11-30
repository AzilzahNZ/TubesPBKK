<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StaffTUController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Menghitung jumlah surat masuk
        $totalSuratDisetujui = DB::table('riwayat_surats')->where('status', 'Disetujui')->count();
        $totalSuratDitolak = DB::table('riwayat_surats')->where('status', 'Ditolak')->count();

        // Mengembalikan view dengan data user dan total surat masuk
        return view('staff-tu.index', compact('user',  'totalSuratDisetujui', 'totalSuratDitolak'));
    }

    public function riwayat_surat( Request $request): View
    {
        $user = Auth::user();

        return view('riwayat-surat', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

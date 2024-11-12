<?php

namespace App\Http\Controllers;

use App\Models\Katalog_Buku;
use App\Models\Peminjaman;
use App\Models\user_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;    
        $userRoles = user_role::where('role', $role)->get();

        $data =[
            'menu' => $userRoles,
        ];

        $katalog__bukus = Katalog_Buku::all();
        return view('pengunjung.katalogBuku', ['katalog__bukus' => $katalog__bukus], $data);
    }

    public function pinjam()
    {
        return view('pengunjung.pinjam');
    }


    public function riwayatPeminjaman()
    {
        $user = Auth::user();
        $role = $user->role;    
        $userRoles = user_role::where('role', $role)->get();

        $data =[
            'menu' => $userRoles,
        ];
        $peminjamans = Peminjaman::all();
        return view('pengunjung.riwayatPeminjaman', ['peminjamans' => $peminjamans], $data);
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

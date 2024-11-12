<?php

namespace App\Http\Controllers;

use App\Models\Katalog_Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Pengunjung;
use App\Models\user_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request): View
    {
        $user = Auth::user();
        $role = $user->role;    
        $userRoles = user_role::where('role', $role)->get();

        $data =[
            'menu' => $userRoles,
        ];
        return view('admin.index', ['user' => $request->user()], $data);
    }

    public function katalogBuku()
    {
        $user = Auth::user();
        $role = $user->role;    
        $userRoles = user_role::where('role', $role)->get();

        $data =[
            'menu' => $userRoles,
        ];
        $katalog__bukus = Katalog_Buku::all();
        return view('admin.katalogBuku', ['katalog__bukus' => $katalog__bukus], $data);
    }

    public function peminjaman()
    {
        $user = Auth::user();
        $pengunjung = Pengunjung::where('user_id', $user->id)->get()[0];
        $peminjamans = Peminjaman::where('pengunjung_id', $pengunjung->id)->get();
        $role = $user->role;    
        $userRoles = user_role::where('role', $role)->get();

        $data =[
            'menu' => $userRoles,
            'name' => $user->name,
            'role' => $user->role,
            'pengunjung' => compact('pengunjung'),
            'peminjaman' => compact('peminjaman'),
        ];
        // $peminjamans = Peminjaman::all();
        return view('admin.peminjaman', compact('peminjamans'), $data);
        // return view('admin.peminjaman', ['peminjamans' => $peminjamans], $data);
    }

    public function pengunjung()
    {
        $user = Auth::user();
        $role = $user->role;    
        $userRoles = user_role::where('role', $role)->get();

        $data =[
            'menu' => $userRoles,
        ];
        $pengunjungs = Pengunjung::all();
        return view('admin.pengunjung', ['pengunjungs' => $pengunjungs], $data);
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
    public function edit(Katalog_Buku $buku)
    {
        return view('edit', ['Katalog_Buku' => $buku]);
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
    public function destroy(Katalog_Buku $buku)
    {
        $buku->delete(); 
        return redirect('');   
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\KatalogBuku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Pengunjung;
use App\Models\User;
use App\Models\user_role;
use App\Models\UserRole;
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
        $userRoles = UserRole::where('role', $role)->get();

        $data =[
            'menu' => $userRoles,
        ];
        return view('admin.index', ['user' => $request->user()], $data);
    }

    public function manajemen_akun_pengguna( Request $request): View
    {
        $user = Auth::user();
        $role = $user->role;    
        $userRoles = UserRole::where('role', $role)->get();

        $data =[
            'menu' => $userRoles,
        ];
        return view('admin.manajemen-akun-pengguna', ['user' => $request->user()], $data);
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
    public function edit()
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */

}

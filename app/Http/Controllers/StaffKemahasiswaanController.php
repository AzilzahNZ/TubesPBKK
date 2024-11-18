<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StaffKemahasiswaanController extends Controller
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
        return view('staff-kemahasiswaan.index', ['user' => $request->user()], $data);
    }

    public function surat_masuk( Request $request): View
    {
        $user = Auth::user();
        $role = $user->role;    
        $userRoles = UserRole::where('role', $role)->get();

        $data =[
            'menu' => $userRoles,
        ];
        return view('staff-kemahasiswaan.surat-masuk', ['user' => $request->user()], $data);
    }

    public function surat_keluar( Request $request): View
    {
        $user = Auth::user();
        $role = $user->role;    
        $userRoles = UserRole::where('role', $role)->get();

        $data =[
            'menu' => $userRoles,
        ];
        return view('staff-kemahasiswaan.surat-keluar', ['user' => $request->user()], $data);
    }

    public function riwayat_surat( Request $request): View
    {
        $user = Auth::user();
        $role = $user->role;    
        $userRoles = UserRole::where('role', $role)->get();

        $data =[
            'menu' => $userRoles,
        ];
        return view('staff-kemahasiswaan.riwayat-surat', ['user' => $request->user()], $data);
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

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        return view('admin.index', compact('user'));
    }

    // public function manajemen_akun_pengguna(Request $request)
    // {

    //     $user = Auth::user();
    //     $users = User::all();

    //     $search = $request->input('search');
    //     // Query pencarian yang benar dengan menggunakan whereHas untuk relasi user
    //     $users = User::query()
    //         ->when($search, function ($query, $search) {
    //             return $query->where('user', function ($q) use ($search) {
    //                 // Mencari berdasarkan kolom 'name' dan 'email' di tabel 'users'
    //                 $q->where('name', 'like', "%{$search}%")
    //                     ->orWhere('email', 'like', "%{$search}%")
    //                     ->orWhere('no_telepon', 'like', "%{$search}%");  // Pencarian di kolom 'no_telepon' pada tabel 'users'
    //             });
    //         })
    //         ->get();

    //     return view('admin.manajemen-akun-pengguna', compact('users'));
    // }

    public function manajemen_akun_pengguna(Request $request)
    {
        $user = Auth::user();
        $users = User::all();
        
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('no_telepon', 'like', "%{$search}%");
            })
            ->paginate(10);  // 10 data per halaman

        return view('admin.manajemen-akun-pengguna', compact('users', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    // Menampilkan form untuk membuat pengguna baru
    public function create()
    {
        return view('admin.create-pengguna');
    }

    /**
     * Store a newly created resource in storage.
     */
    // Menyimpan data pengguna baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'no_telepon' => 'required|string|max:15',
        ]);

        // Menyimpan data pengguna baru
        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Enkripsi password
        $user->no_telepon = $request->no_telepon;
        $user->save();

        // Redirect atau tampilkan notifikasi sukses
        return redirect()->route('admin.manajemen-akun-pengguna')->with('success', 'Akun pengguna berhasil dibuat.');
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

    public function updatePengguna(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_telepon' => 'required|string|max:15',
            'password' => 'nullable|string|min:8',
        ]);

        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);

        // Update data pengguna
        $user->update([
            'name' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'no_telepon' => $request->no_telepon,
        ]);

        // // Update data tambahan (misalnya no_telepon jika ada relasi)
        // if ($user->pengguna) {
        //     $user->pengguna->update([
        //         'no_telepon' => $request->no_telepon,
        //     ]);
        // }

        return redirect()->back()->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function deletePengguna($id)
    {
        $user = User::findOrFail($id); // Cari data berdasarkan ID
        $user->delete(); // Hapus data

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function create()
    {
        return view('staff-kemahasiswaan.surat-keluar');
    }
}

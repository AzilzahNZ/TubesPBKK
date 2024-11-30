<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\RiwayatSurat;
use Illuminate\Http\Request;
use App\Models\RiwayatPengajuanSurat;

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
        $surat_masuks = SuratMasuk::where('status', '=', 'diproses')->get();

        return view('staff-kemahasiswaan.surat-masuk', compact('surat_masuks'));
    }

    public function create()
    {
        return view('staff-kemahasiswaan.surat-keluar');
    }

    public function detail($id)
    {
        $suratMasuk = SuratMasuk::with('user')->findOrFail($id); // Load data user sekaligus
        return view('staff-kemahasiswaan.detail-surat-masuk', compact('suratMasuk'));
    }

    // App\Http\Controllers\SuratMasukController.php

    // App\Http\Controllers\SuratMasukController.php

    public function approve($id)
    {
        // Ambil data surat masuk
        $suratMasuk = SuratMasuk::findOrFail($id);

        $kategori = 'Surat Masuk';

        // Ubah status surat masuk menjadi "disetujui"
        $suratMasuk->status = 'disetujui';
        $suratMasuk->save();  // Menyimpan perubahan status surat masuk

        // Cari data riwayat pengajuan yang terkait dengan surat ini
        $riwayatPengajuan = RiwayatPengajuanSurat::where('surat_masuk_id', $suratMasuk->id)->first();

        if ($riwayatPengajuan) {
            // Update status riwayat pengajuan menjadi "disetujui"
            $riwayatPengajuan->status = 'disetujui';
            $riwayatPengajuan->save();
        }

        // Pindahkan surat ke riwayat surat (jika diperlukan untuk log riwayat)
        RiwayatSurat::create([
            'surat_masuk_id' => $suratMasuk->id,
            'nama_ormawa' => $suratMasuk->user->name,
            'tanggal_surat_masuk_keluar' => now(),
            'kategori' => $kategori,
            'nomor_surat' => $suratMasuk->nomor_surat,
            'jenis_surat' => $suratMasuk->jenis_surat,
            'nama_kegiatan' => $suratMasuk->nama_kegiatan,
            'penanggung_jawab' => $suratMasuk->penanggung_jawab,
            'file_surat' => $suratMasuk->file_surat,
            'status' => 'disetujui',
        ]);

        // Redirect kembali ke halaman surat masuk
        return redirect()->route('staff-kemahasiswaan.surat-masuk')->with('success', 'Surat telah disetujui');
    }



    public function reject(Request $request, $id)
    {
        $suratMasuk = SuratMasuk::findOrFail($id);

        // Pindahkan data ke tabel riwayat_surat
        RiwayatSurat::create([
            'surat_masuk_id' => $suratMasuk->id,
            'nama_ormawa' => $suratMasuk->user->name,
            'tanggal_surat_masuk_keluar' => now(),
            'kategori' => 'Surat Masuk',
            'nomor_surat' => $suratMasuk->nomor_surat,
            'jenis_surat' => $suratMasuk->jenis_surat,
            'nama_kegiatan' => $suratMasuk->nama_kegiatan,
            'penanggung_jawab' => $suratMasuk->penanggung_jawab,
            'file_surat' => $suratMasuk->file_surat,
            'status' => 'Ditolak',
        ]);

        // Update status di tabel surat_masuk menjadi Ditolak
        $suratMasuk->status = 'Ditolak';
        $suratMasuk->save();

        // Update status di riwayat_pengajuan
        RiwayatPengajuanSurat::where('surat_masuk_id', $id)->update([
            'status' => 'Ditolak',
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('staff-kemahasiswaan.surat-masuk')->with('success', 'Surat berhasil ditolak.');
    }
}

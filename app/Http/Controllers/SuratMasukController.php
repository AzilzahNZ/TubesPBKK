<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\RiwayatSurat;
use Illuminate\Http\Request;
use App\Models\RiwayatPengajuanSurat;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = SuratMasuk::query();
        $perPage = $request->input('per_page', 10); // Default 10 entri per halaman

        // Pencarian Global
        if ($request->filled('search')) {
            $search = $request->search;
            $columns = Schema::getColumnListing('surat_masuks'); // Nama tabel
            $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $search . '%');
                }
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

        // Menambahkan filter status yang tidak Disetujui, Ditolak, atau Dibatalkan
        $query->whereNotIn('status', ['Disetujui', 'Ditolak', 'Dibatalkan']);

        // Implementasi Pagination dengan appends()
        $surat_masuks = $query->paginate($perPage)->appends($request->query());

        return view('staff-kemahasiswaan.surat-masuk', compact('surat_masuks', 'perPage'));
    }


    // public function create()
    // {
    //     return view('staff-kemahasiswaan.surat-keluar');
    // }

    public function detail($id)
    {
        $suratMasuk = SuratMasuk::with('user')->findOrFail($id); // Load data user sekaligus
        return view('staff-kemahasiswaan.detail-surat-masuk', compact('suratMasuk'));
    }

    // App\Http\Controllers\SuratMasukController.php

    // App\Http\Controllers\SuratMasukController.php

    public function approve(Request $request, $id)
    {
        // Ambil data surat masuk
        $suratMasuk = SuratMasuk::findOrFail($id);

        $kategori = 'Surat Masuk';

        if ($suratMasuk->jenis_surat === 'Proposal Permohonan Dana') {
            $request->validate([
                'nominal_dana_disetujui' => 'required|numeric|min:0',
            ]);
            $suratMasuk->nominal_dana_disetujui = $request->input('nominal_dana_disetujui'); // Menyimpan nominal dana
            $suratMasuk->save();
        }

        // Cari data riwayat pengajuan yang terkait dengan surat ini
        $riwayatPengajuan = RiwayatPengajuanSurat::where('surat_masuk_id', $suratMasuk->id)->first();
        if ($riwayatPengajuan) {
            // Update status riwayat pengajuan menjadi "disetujui"
            $riwayatPengajuan->status = 'disetujui';
            $riwayatPengajuan->nominal_dana_disetujui = $suratMasuk->nominal_dana_disetujui;
            $riwayatPengajuan->save();
        }

        // Pindahkan surat ke riwayat surat (jika 6erlukan untuk log riwayat)
        $test = RiwayatSurat::create([
            'surat_masuk_id' => $suratMasuk->id,
            'nama_ormawa' => $suratMasuk->user->name,
            'tanggal_surat_masuk_keluar' => now(),
            'kategori' => $kategori,
            'nomor_surat' => $suratMasuk->nomor_surat,
            'jenis_surat' => $suratMasuk->jenis_surat,
            'nama_kegiatan' => $suratMasuk->nama_kegiatan,
            'penanggung_jawab' => $suratMasuk->penanggung_jawab,
            'file_surat' => $suratMasuk->file_surat,
            'nominal_dana' => $suratMasuk->nominal_dana,
            'status' => 'disetujui',
            'nominal_dana_disetujui' => $suratMasuk->nominal_dana_disetujui
        ]);
        $test->save();

        // Ubah status surat masuk menjadi "disetujui"
        $suratMasuk->status = 'disetujui';
        $suratMasuk->save();  // Menyimpan perubahan status surat masuk

        // Kirim notifikasi WhatsApp
        $this->sendWhatsAppNotification($suratMasuk->user->no_telepon, $suratMasuk);

        // Redirect kembali ke halaman surat masuk
        return redirect()->route('staff-kemahasiswaan.surat-masuk')->with('success', 'Surat telah disetujui');
    }

    public function sendWhatsAppNotification($nomorTelepon, $suratMasuk)
    {
        try {
            if (!$nomorTelepon) {
                Log::warning('Nomor telepon tidak ditemukan.');
                return false;
            }

            // Format pesan berdasarkan jenis surat
            $message = match ($suratMasuk->jenis_surat) {
                'Proposal Permohonan Dana' =>
                "Haloo {$suratMasuk->user->name}, ini SIMPULS.\n"
                    . "Proposal permohonan dana Anda telah *DISETUJUI* dengan rincian sebagai berikut:\n\n"
                    . "Nomor Surat: {$suratMasuk->nomor_surat}\n"
                    . "Jenis Surat: {$suratMasuk->jenis_surat}\n"
                    . "Nama Kegiatan: {$suratMasuk->nama_kegiatan}\n"
                    . "Penanggung Jawab: {$suratMasuk->penanggung_jawab}\n"
                    . "Nominal Dana Disetujui: Rp " . number_format($suratMasuk->nominal_dana_disetujui, 0, ',', '.') . "\n\n"
                    . "Silakan mengumpulkan Laporan Pertanggung Jawaban(LPJ) Kegiatan setelah kegiatan selesai dilaksanakan ke Loket Kemahasiswaan.",
                default =>
                "Haloo {$suratMasuk->user->name}, ini SIMPULS.\n"
                    . "Surat Anda telah *DISETUJUI* dan bisa diambil 2 hari ke depan di Loket Kemahasiswaan:\n\n"
                    . "Nomor Surat: {$suratMasuk->nomor_surat}\n"
                    . "Jenis Surat: {$suratMasuk->jenis_surat}\n"
                    . "Nama Kegiatan: {$suratMasuk->nama_kegiatan}\n"
                    . "Penanggung Jawab: {$suratMasuk->penanggung_jawab}\n",
            };

            $response = Http::withHeaders([
                'Authorization' => '1gDkUvyVMXaej64QEsrZ',
            ])->post('https://api.fonnte.com/send', [
                'target' => $nomorTelepon,
                'message' => $message,
            ]);

            if ($response->successful()) {
                Log::info('Pesan WhatsApp berhasil dikirim.');
                return true;
            } else {
                Log::warning('Pesan WhatsApp gagal dikirim: ' . $response->body());
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat mengirim pesan WhatsApp: ' . $e->getMessage());
            return false;
        }
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
            'nominal_dana' => $suratMasuk->nominal_dana,
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

        // Kirim notifikasi WhatsApp
        $this->sendWhatsAppNotificationRejected($suratMasuk->user->no_telepon, $suratMasuk, $request->keterangan);

        return redirect()->route('staff-kemahasiswaan.surat-masuk')->with('success', 'Surat berhasil ditolak.');
    }

    public function sendWhatsAppNotificationRejected($nomorTelepon, $suratMasuk, $keterangan)
    {
        try {
            if (!$nomorTelepon) {
                Log::warning('Nomor telepon tidak ditemukan.');
                return false;
            }

            $response = Http::withHeaders([
                'Authorization' => '1gDkUvyVMXaej64QEsrZ',
            ])->post('https://api.fonnte.com/send', [
                'target' => $nomorTelepon,
                'message' => "Haloo {$suratMasuk->user->name}, ini SIMPULS. \nMaaf, surat Anda telah *DITOLAK* dengan alasan berikut:\n\n*Keterangan Penolakan*: {$keterangan}\n\nNomor Surat: {$suratMasuk->nomor_surat}\nJenis Surat: {$suratMasuk->jenis_surat}\nNama Kegiatan: {$suratMasuk->nama_kegiatan}\nPenanggung Jawab: {$suratMasuk->penanggung_jawab}\n\nSilakan perbaiki atau ajukan ulang jika memungkinkan.",
            ]);

            if ($response->successful()) {
                Log::info('Pesan WhatsApp berhasil dikirim.');
                return true;
            } else {
                Log::warning('Pesan WhatsApp gagal dikirim: ' . $response->body());
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat mengirim pesan WhatsApp: ' . $e->getMessage());
            return false;
        }
    }
}

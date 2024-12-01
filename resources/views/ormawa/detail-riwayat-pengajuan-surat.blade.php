@extends('template') <!-- Sesuaikan dengan layout utama Anda -->

@section('content')
<div class="card card-body" style="max-width: 100%; margin: 0 auto; padding: 10px;">
    <h1 class="fs-4 fw-bold mb-4 text-center">Detail Surat</h1>
    <table class="table table-bordered" style="max-width: 100%;">
        <tr>
            <th>Pengirim</th>
            <td>{{ $riwayat_pengajuan_surats->user->name }}</td> <!-- Mengakses nama pengguna dari relasi -->
        </tr>
        <tr>
            <th>Tanggal Diajukan</th>
            <td>{{ \Carbon\Carbon::parse($riwayat_pengajuan_surats->tanggal_diajukan)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <th>Nomor Surat</th>
            <td>{{ $riwayat_pengajuan_surats->nomor_surat }}</td>
        </tr>
        <tr>
            <th>Jenis Surat</th>
            <td>{{ $riwayat_pengajuan_surats->jenis_surat }}</td>
        </tr>
        <tr>
            <th>Nama Kegiatan</th>
            <td>{{ $riwayat_pengajuan_surats->nama_kegiatan }}</td>
        </tr>
        <tr>
            <th>Penanggung Jawab</th>
            <td>{{ $riwayat_pengajuan_surats->penanggung_jawab }}</td>
        </tr>
        <tr>
            <th>File Surat</th>
            <td><a href="{{ asset('storage/' . $riwayat_pengajuan_surats->file_surat) }}" target="_blank">Unduh</a></td>
        </tr>
        <tr>
            <th>Nominal Dana yang Diajukan</th>
            <td>{{ $riwayat_pengajuan_surats->nominal_dana !== null ? 'Rp ' . number_format($riwayat_pengajuan_surats->nominal_dana, 0, ',', '.') : '-' }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $riwayat_pengajuan_surats->status }}</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>{{ $riwayat_pengajuan_surats->keterangan }}</td>
        </tr>
    </table>

    <div class="d-flex justify-content-between">
        <!-- Tombol Kembali -->
        <a href="{{ route('ormawa.riwayat-pengajuan-surat') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection

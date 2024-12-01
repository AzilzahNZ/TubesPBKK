@extends('template') <!-- Sesuaikan dengan layout utama Anda -->

@section('content')
<div class="card card-body" style="max-width: 100%; margin: 0 auto; padding: 10px;">
    <h1 class="fs-4 fw-bold mb-4 text-center">Detail Surat</h1>
    <table class="table table-bordered" style="max-width: 100%;">
        <tr>
            <th>Pengirim</th>
            <td>{{ $riwayat_surats->nama_ormawa }}</td> <!-- Mengakses nama pengguna dari relasi -->
        </tr>
        <tr>
            <th>Tanggal Diajukan</th>
            <td>{{ $riwayat_surats->tanggal_surat_masuk_keluar }}</td>
        </tr>
        <tr>
            <th>Nomor Surat</th>
            <td>{{ $riwayat_surats->nomor_surat }}</td>
        </tr>
        <tr>
            <th>Jenis Surat</th>
            <td>{{ $riwayat_surats->jenis_surat }}</td>
        </tr>
        <tr>
            <th>Nama Kegiatan</th>
            <td>{{ $riwayat_surats->nama_kegiatan }}</td>
        </tr>
        <tr>
            <th>Penanggung Jawab</th>
            <td>{{ $riwayat_surats->penanggung_jawab }}</td>
        </tr>
        <tr>
            <th>File Surat</th>
            <td><a href="{{ asset('storage/' . $riwayat_surats->file_surat) }}" target="_blank">Unduh</a></td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $riwayat_surats->status }}</td>
        </tr>
    </table>

    <div class="d-flex justify-content-between">
        <!-- Tombol Kembali -->
        <a href="{{ route('riwayat-surat') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection

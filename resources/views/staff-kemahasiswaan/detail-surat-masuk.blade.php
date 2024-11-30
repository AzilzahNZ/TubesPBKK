@extends('template') <!-- Sesuaikan dengan layout utama Anda -->

@section('content')
<div class="container">
    <h2>Detail Surat Masuk</h2>
    <table class="table table-bordered">
        <tr>
            <th>Nama Pengirim</th>
            <td>{{ $suratMasuk->user->name }}</td> <!-- Mengakses nama pengguna dari relasi -->
        </tr>
        <tr>
            <th>Tanggal Diajukan</th>
            <td>{{ $suratMasuk->tanggal_diajukan }}</td>
        </tr>
        <tr>
            <th>Nomor Surat</th>
            <td>{{ $suratMasuk->nomor_surat }}</td>
        </tr>
        <tr>
            <th>Jenis Surat</th>
            <td>{{ $suratMasuk->jenis_surat }}</td>
        </tr>
        <tr>
            <th>Nama Kegiatan</th>
            <td>{{ $suratMasuk->nama_kegiatan }}</td>
        </tr>
        <tr>
            <th>Penanggung Jawab</th>
            <td>{{ $suratMasuk->penanggung_jawab }}</td>
        </tr>
        <tr>
            <th>File Surat</th>
            <td><a href="{{ asset('storage/' . $suratMasuk->file_surat) }}" target="_blank">Unduh</a></td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $suratMasuk->status }}</td>
        </tr>
    </table>

    <div class="d-flex justify-content-between">
        <!-- Tombol Kembali -->
        <a href="{{ route('staff-kemahasiswaan.surat-masuk') }}" class="btn btn-secondary">Kembali</a>
        
        <div>
            <!-- Form untuk Setuju -->
            <form action="{{ route('staff-kemahasiswaan.approve-surat', $suratMasuk->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-success">Setujui</button>
            </form>

            <!-- Tombol Tolak -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">Tolak</button>
        </div>
    </div>
</div>

<!-- Modal untuk Penolakan -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">Konfirmasi Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('staff-kemahasiswaan.reject-surat', $suratMasuk->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Masukkan alasan penolakan:</p>
                    <textarea class="form-control" name="reason" rows="3" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger">Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

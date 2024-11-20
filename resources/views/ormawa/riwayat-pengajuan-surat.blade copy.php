@extends('template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div style="max-width: 1200px; margin: 0 auto; padding: 10px;">
                        <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Riwayat Pengajuan Surat</h1>

                        {{-- Filter dan Pencarian --}}
                        <div class="d-flex justify-content-end mb-3">
                            <form method="GET" action="{{ route('ormawa.riwayat-pengajuan-surat') }}"
                                style="display: flex; gap: 5px; flex-wrap: wrap;">
                                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                                    style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">

                                <select name="jenis_surat"
                                    style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                                    <option value="">Jenis Surat</option>
                                    <option value="Permohonan Izin Kegiatan"
                                        {{ request('jenis_surat') == 'Permohonan Izin Kegiatan' ? 'selected' : '' }}>
                                        Permohonan Izin Kegiatan</option>
                                    <option value="Proposal Permohonan Dana"
                                        {{ request('jenis_surat') == 'Proposal Permohonan Dana' ? 'selected' : '' }}>
                                        Proposal Permohonan Dana</option>
                                    <option value="Peminjaman Ruangan"
                                        {{ request('jenis_surat') == 'Peminjaman Ruangan' ? 'selected' : '' }}>Peminjaman
                                        Ruangan</option>
                                    <option value="Peminjaman Kamera"
                                        {{ request('jenis_surat') == 'Peminjaman Kamera' ? 'selected' : '' }}>Peminjaman
                                        Kamera</option>
                                </select>

                                <select name="status"
                                    style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                                    <option value="">Status</option>
                                    <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>
                                        Diproses</option>
                                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>

                                <select name="sort"
                                    style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru
                                    </option>
                                    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama
                                    </option>
                                </select>

                                <button type="submit"
                                    style="padding: 8px 16px; background-color: #0d6efd; color: white; border: none; border-radius: 4px; cursor: pointer;">
                                    Filter
                                </button>
                            </form>
                            <div style="margin-left: 5px;">
                                <form method="GET" action="{{ route('ormawa.riwayat-pengajuan-surat') }}">
                                    <button type="submit"
                                        style="padding: 10px 16px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">
                                        Hapus Filter
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Tabel Riwayat --}}
                        @if ($riwayat_pengajuan_surats->isEmpty())
                            <div class="alert alert-warning" role="alert" style="text-align: center;">
                                Tidak ada data yang ditemukan berdasarkan filter atau pencarian Anda.
                            </div>
                        @else
                            {{-- Tampilkan tabel jika data ditemukan --}}
                            <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; margin-bottom: 20px;">
                                <table
                                    style="width: 100%; border-collapse: collapse; background-color: white; border: 1px solid #ddd; white-space: nowrap;">
                                    <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; margin-bottom: 20px;">
                                        <table
                                            style="width: 100%; border-collapse: collapse; background-color: white; border: 1px solid #ddd; white-space: nowrap;">
                                            <thead>
                                                <tr style="background-color: #f8f9fa;">
                                                    <th
                                                        style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                                        No</th>
                                                    <th
                                                        style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                                        Tanggal Diajukan</th>
                                                    <th
                                                        style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                                        Nomor Surat</th>
                                                    <th
                                                        style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                                        Jenis Surat</th>
                                                    <th
                                                        style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                                        Nama Kegiatan</th>
                                                    <th
                                                        style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                                        PJ</th>
                                                    <th
                                                        style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                                        File Surat</th>
                                                    <th
                                                        style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                                        Status</th>
                                                    <th
                                                        style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                                        Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayat_pengajuan_surats as $dt)
                                                    <tr>
                                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                                            {{ $loop->iteration }}</td>
                                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                                            {{ \Carbon\Carbon::parse($dt->tanggal_diajukan)->format('d F Y') }}
                                                        </td>
                                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                                            {{ $dt->nomor_surat }}</td>
                                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                                            {{ $dt->jenis_surat }}</td>
                                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                                            {{ $dt->nama_kegiatan }}</td>
                                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                                            {{ $dt->penanggung_jawab }}</td>
                                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                                            <a href="{{ asset('storage/' . $dt->file_surat) }}"
                                                                target="_blank"
                                                                style="color: #0d6efd; text-decoration: none;">
                                                                Lihat
                                                            </a>
                                                        </td>
                                                        <!-- <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                                            <span
                                                                style="color: {{ $dt->status == 'Selesai' ? '#198754' : '#fd7e14' }};">
                                                                {{ $dt->status }}
                                                            </span>
                                                        </td> -->
                                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                                            <a class="btn btn-sm btn-warning" data-id="{{ $dt->id }}"
                                                                style="margin-right: 5px;">Edit</a>
                                                            <form
                                                                action="{{ route('ormawa.destroy-pengajuan-surat', $dt->id) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    style="padding: 6px 12px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;"
                                                                    onclick="return confirm('Yakin ingin membatalkan?')">
                                                                    Batal
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                        @endif

                        {{-- Modal Edit --}}
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Riwayat Pengajuan Surat</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="editForm" method="POST" action="">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="jenis_surat" class="form-label">Jenis Surat</label>
                                                <select name="jenis_surat" id="jenis_surat" class="form-control">
                                                    <option value="Permohonan Izin Kegiatan">Permohonan Izin Kegiatan
                                                    </option>
                                                    <option value="Proposal Permohonan Dana">Proposal Permohonan Dana
                                                    </option>
                                                    <option value="Peminjaman Ruangan">Peminjaman Ruangan</option>
                                                    <option value="Peminjaman Kamera">Peminjaman Kamera</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                                <input type="text" name="nama_kegiatan" id="nama_kegiatan"
                                                    class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                                                <input type="text" name="penanggung_jawab" id="penanggung_jawab"
                                                    class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="Diproses">Diproses</option>
                                                    <option value="Selesai">Selesai</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- JavaScript --}}
                        <script>
                            document.querySelectorAll('.btn-warning').forEach(button => {
                            button.addEventListener('click', function() {
                                const id = this.getAttribute('data-id');
                                const modal = new bootstrap.Modal(document.getElementById('editModal'));
                                const form = document.getElementById('editForm');

                                // Fetch data dari server
                                fetch(`/ormawa.riwayat-pengajuan-surat/${id}/edit`)
                                    .then(response => response.json())
                                    .then(data => {
                                        // Isi form modal dengan data yang didapat
                                        document.getElementById('tanggal_surat').value = data.tanggal_surat;
                                        document.getElementById('nomor_surat').value = data.nomor_surat;
                                        document.getElementById('jenis_surat').value = data.jenis_surat;
                                        document.getElementById('nama_kegiatan').value = data.nama_kegiatan;
                                        document.getElementById('penanggung_jawab').value = data.penanggung_jawab;
                                        document.getElementById('file_surat').value = data.file_surat;
                                        document.getElementById('status').value = data.status;

                                        // Update action form dengan ID yang benar
                                        form.action = `/ormawa.riwayat-pengajuan-surat/${id}`;

                                        // Tampilkan modal
                                        modal.show();
                                    })
                                    .catch(error => console.error('Error fetching data:', error));
                            });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

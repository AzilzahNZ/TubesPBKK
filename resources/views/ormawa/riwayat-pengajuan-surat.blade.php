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
                                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak
                                    </option>
                                    <option value="Diterima" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>
                                        Disetujui</option>
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
                                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                                            <span
                                                                style="color: {{ $dt->status == 'Selesai' ? '#198754' : '#fd7e14' }};">
                                                                {{ $dt->status }}
                                                            </span>
                                                        </td>
                                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                                            <a href="#editModal-{{ $dt->id }}"
                                                                class="btn btn-sm btn-warning"
                                                                data-bs-toggle="modal">Edit</a>
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

                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                const editButtons = document.querySelectorAll('.btn-warning'); // Tombol Edit
                                const editForm = document.getElementById('editForm'); // Formulir di modal
                                const tanggal_diajukanInput = document.getElementById('tanggal_diajukan');
                                const nomor_suratInput = document.getElementById('nomor_surat');
                                const jenis_suratInput = document.getElementById('jenis_surat');
                                const nama_kegiatanInput = document.getElementById('nama_kegiatan');
                                const penanggung_jawabInput = document.getElementById('penanggung_jawab');
                                const file_suratInput = document.getElementById('file_surat');


                                // Event listener untuk tombol Edit
                                editButtons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        const row = this.closest('tr'); // Baris tabel pengguna
                                        const userId = this.getAttribute('data-id'); // Ambil ID pengguna
                                        const tanggal_diajukan = row.querySelector('td:nth-child(2)').textContent.trim();
                                        const nomor_surat = row.querySelector('td:nth-child(3)').textContent.trim();
                                        const jenis_surat = row.querySelector('td:nth-child(4)').textContent.trim();
                                        const nama_kegiatan = row.querySelector('td:nth-child(5)').textContent.trim();
                                        const penanggung_jawab = row.querySelector('td:nth-child(6)').textContent.trim();
                                        const file_surat = row.querySelector('td:nth-child(7)').textContent.trim();

                                        // Isi form modal dengan data pengguna
                                        tanggal_diajukanInput.value = tanggal_diajukan;
                                        nomor_suratInput.value = nomor_surat;
                                        jenis_suratInput.value = jenis_surat;
                                        nama_kegiatanInput.value = nama_kegiatan;
                                        penanggung_jawabInput.value = penanggung_jawab;
                                        file_suratInput.value = file_surat;

                                        // Set action URL form dengan ID pengguna
                                        editForm.action = `/ormawa/edit-pengajuan-surat/${userId}`;

                                        // Tampilkan modal
                                        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                                        editModal.show();
                                    });
                                });
                            });
                        </script>

                        <!-- Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <!-- Header Modal -->
                                    <div class="modal-header" style="border: none;">
                                        <h5 class="modal-title w-100 text-center" id="editModalLabel"
                                            style="font-weight: bold; font-size: 1.25rem;">
                                            Edit Pengajuan Surat
                                        </h5>
                                        <!-- Tombol X -->
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <!-- Form Modal -->
                                    <form id="editForm" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body" style="padding: 20px;">
                                            <!-- tanggal_diajukan -->
                                            <div class="mb-3">
                                                <label for="tanggal_diajukan" class="form-label"
                                                    style="font-weight: bold;">Tanggal Diajukan</label>
                                                <input type="date" class="form-control" id="tanggal_diajukan" name="tanggal_diajukan"
                                                    required style="border-radius: 5px;">
                                            </div>
                                            <!-- Nomor Surat -->
                                            <div class="mb-3">
                                                <label for="nomor_surat" class="form-label"
                                                    style="font-weight: bold;">Nomor Surat</label>
                                                <input type="text" class="form-control" id="nomor_surat" name="nomor_surat"
                                                    required style="border-radius: 5px;">
                                            </div>
                                            <!-- Jenis Surat -->
                                            <div class="mb-3">
                                                <label for="jenis_surat" class="form-label"
                                                    style="font-weight: bold;">Jenis Surat</label>
                                                <input type="text" class="form-control" id="jenis_surat" name="jenis_surat"
                                                    required style="border-radius: 5px;">
                                            </div>
                                            <!-- Nama Kegiatan -->
                                            <div class="mb-3">
                                                <label for="nama_kegiatan" class="form-label"
                                                    style="font-weight: bold;">Nama Kegiatan</label>
                                                <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                                                    required style="border-radius: 5px;">
                                            </div>
                                            <!-- Penanggung Jawab -->
                                            <div class="mb-3">
                                                <label for="penanggung_jawab" class="form-label"
                                                    style="font-weight: bold;">Penanggung Jawab</label>
                                                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                                                    required style="border-radius: 5px;">
                                            </div>
                                            <!-- File Surat -->
                                            <div class="mb-3">
                                                <label for="file_surat" class="form-label"
                                                    style="font-weight: bold;">File Surat</label>
                                                <input type="file" class="form-control" id="file_surat" name="file_surat"
                                                    required style="border-radius: 5px;">
                                            </div>
                                        </div>
                                        
                                        <!-- Footer Modal -->
                                        <div class="modal-footer"
                                            style="border: none; justify-content: center; padding: 15px 0;">
                                            <button type="submit" class="btn btn-primary"
                                                style="padding: 10px 30px;">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Konfirmasi Delete -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header" style="border: none;">
                                        <h5 class="modal-title w-100 text-center" id="deleteModalLabel"
                                            style="font-weight: bold; font-size: 1.25rem;">
                                            Konfirmasi Hapus Akun
                                        </h5>
                                    </div>
                                    <div class="modal-body text-center" style="padding: 20px;">
                                        <p>Apakah Anda yakin ingin menghapus Akun ini?</p>
                                    </div>
                                    <div class="modal-footer" style="border: none; justify-content: center;">
                                        <form id="deleteForm" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                style="padding: 10px 30px;">Hapus</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            style="padding: 10px 30px;">Batal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

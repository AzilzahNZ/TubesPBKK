@extends('template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div style="max-width: 1200px; margin: 0 auto; padding: 10px;">
                        <h1 class="fs-4 fw-bold mb-4">Riwayat Pengajuan Surat</h1>

                        {{-- Filter dan Pencarian --}}
                        <div class="d-flex justify-content-end mb-3">
                            <form method="GET" action="{{ route('ormawa.riwayat-pengajuan-surat') }}"
                                class="d-flex gap-2 flex-wrap">
                                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                                    class="form-input">

                                <select name="jenis_surat" class="form-input">
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

                                <select name="status" class="form-input">
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

                                <select name="sort" class="form-input">
                                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru
                                    </option>
                                    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama
                                    </option>
                                </select>

                                <button type="submit" class="form-button form-button-primary">Filter</button>
                            </form>
                            <form method="GET" action="{{ route('ormawa.riwayat-pengajuan-surat') }}" class="ms-2">
                                <button type="submit" class="form-button form-button-danger">Hapus Filter</button>
                            </form>
                        </div>

                        {{-- Tabel Riwayat --}}
                        @if ($riwayat_pengajuan_surats->isEmpty())
                            <div class="alert alert-warning">
                                Belum ada data Riwayat Pengajuan Surat.
                            </div>
                        @else
                            <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; margin-bottom: 20px;">
                                <table
                                    style="width: 100%; border-collapse: collapse; border: 1px solid #ddd; white-space: nowrap;">
                                    <thead>
                                        <tr class="table-header">
                                            <th class="table-cell">No</th>
                                            <th class="table-cell">Tanggal Diajukan</th>
                                            <th class="table-cell">Nomor Surat</th>
                                            <th class="table-cell">Jenis Surat</th>
                                            <th class="table-cell">Nama Kegiatan</th>
                                            <th class="table-cell">PJ</th>
                                            <th class="table-cell">File Surat</th>
                                            <th class="table-cell">Status</th>
                                            <th class="table-cell">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayat_pengajuan_surats as $dt)
                                            <tr>
                                                <td class="table-cell">{{ $loop->iteration }}</td>
                                                <td class="table-cell">
                                                    {{ Carbon\Carbon::parse($dt->tanggal_diajukan)->format('d F Y') }}</td>
                                                <td class="table-cell">{{ $dt->nomor_surat }}</td>
                                                <td class="table-cell">{{ $dt->jenis_surat }}</td>
                                                <td class="table-cell">{{ $dt->nama_kegiatan }}</td>
                                                <td class="table-cell">{{ $dt->penanggung_jawab }}</td>
                                                <td class="table-cell">
                                                    <a href="{{ asset('storage/' . $dt->file_surat) }}" target="_blank"
                                                        class="text-primary text-decoration-none">Lihat</a>
                                                </td>
                                                <td class="table-cell">
                                                    <span
                                                        class="{{ $dt->status == 'Selesai' ? 'status-finish' : 'status-pending' }}">{{ $dt->status }}</span>
                                                </td>
                                                <td class="table-cell">
                                                    <a class="btn btn-sm btn-warning"
                                                        data-id="{{ $dt->id }}">Edit</a>
                                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        onclick="setDeleteData('{{ $dt->id }}')">Batal</button>
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
                                const tanggalDiajukanInput = document.getElementById('tanggal_diajukan'); // Input Tanggal Diajukan
                                const nomorSuratInput = document.getElementById('nomor_surat'); // Input Nomor Surat
                                const jenisSuratInput = document.getElementById('jenis_surat'); // Input Jenis Surat
                                const namaKegiatanInput = document.getElementById('nama_kegiatan'); // Input Nama Kegiatan
                                const penanggungJawabInput = document.getElementById('penanggung_jawab'); // Input Penanggung Jawab
                                const fileSuratLink = document.getElementById('file_surat_link'); // Link File Surat

                                editButtons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        const row = this.closest('tr'); // Baris tabel
                                        const pengajuanId = this.getAttribute('data-id'); // Ambil ID dari tombol
          
                                        // Ambil tanggal dari tabel
                                        const tanggalText = row.querySelector('td:nth-child(2)').textContent.trim();
                                        const [day, month, year] = tanggalText.split(" ");
                                        const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                                            "Agustus", "September", "Oktober", "November", "Desember"
                                        ];
                                        const monthNumber = months.indexOf(month) + 1;
                                        const formattedTanggal =
                                            `${year}-${monthNumber.toString().padStart(2, '0')}-${day.padStart(2, '0')}`;
                                        tanggalDiajukanInput.value = formattedTanggal;

                                        const nomorSurat = row.querySelector('td:nth-child(3)').textContent
                                            .trim(); // Ambil Nomor Surat
                                        const jenisSurat = row.querySelector('td:nth-child(4)').textContent
                                            .trim(); // Ambil Jenis Surat
                                        const namaKegiatan = row.querySelector('td:nth-child(5)').textContent
                                            .trim(); // Ambil Nama Kegiatan
                                        const penanggungJawab = row.querySelector('td:nth-child(6)').textContent
                                            .trim(); // Ambil Penanggung Jawab
                                        const fileSuratPath = row.querySelector('td:nth-child(7) a').getAttribute(
                                            'href'); // Ambil Link File Surat

                                        // Isi form dengan data lama
                                        // tanggalDiajukanInput.value = tanggalDiajukan; // Isi Tanggal Diajukan
                                        nomorSuratInput.value = nomorSurat; // Isi Nomor Surat
                                        jenisSuratInput.value = jenisSurat; // Isi Jenis Surat
                                        namaKegiatanInput.value = namaKegiatan; // Isi Nama Kegiatan
                                        penanggungJawabInput.value = penanggungJawab; // Isi Penanggung Jawab
                                        fileSuratLink.href = fileSuratPath; // Tampilkan Link File Surat

                                        // Atur action form dengan ID pengajuan
                                        editForm.action = `/ormawa/edit-pengajuan-surat/${pengajuanId}`;

                                        // Tampilkan modal
                                        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                                        editModal.show();
                                    });
                                });

                                // Reset input file setiap kali modal ditutup
                                const editModalElement = document.getElementById('editModal');
                                editModalElement.addEventListener('hidden.bs.modal', () => {
                                    document.getElementById('file_surat').value = '';
                                });
                            });


                            function setDeleteData(id) {
                                const deleteForm = document.getElementById('deleteForm');
                                deleteForm.action = `/ormawa/destroy-pengajuan-surat/${id}`;
                            };
                        </script>

                        <!-- Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg custom-modal-width">
                                <div class="modal-content">
                                    <!-- Header Modal -->
                                    <div class="modal-header" style="border: none;">
                                        <h5 class="modal-title w-100 text-center" id="editModalLabel"
                                            style="font-weight: bold; font-size: 1.25rem;">
                                            Edit Data Riwayat Pengajuan Surat
                                        </h5>
                                        <!-- Tombol X -->
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <!-- Form Modal -->
                                    <div class="modal-body">
                                        <form action="" method="POST" enctype="multipart/form-data" id="editForm">
                                            @csrf
                                            @method('PUT')
                                            <div class="row g-4">
                                                <!-- Tanggal Diajukan -->
                                                <div class="col-md-6">
                                                    <label for="tanggal_diajukan" class="form-label">Tanggal
                                                        Diajukan</label>
                                                    <input type="date" class="form-control" id="tanggal_diajukan"
                                                        name="tanggal_diajukan" required readonly>
                                                </div>

                                                <!-- Nama Kegiatan -->
                                                <div class="col-md-6">
                                                    <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                                    <input type="text" class="form-control" id="nama_kegiatan"
                                                        name="nama_kegiatan" required>
                                                </div>

                                                <!-- Nomor Surat -->
                                                <div class="col-md-6">
                                                    <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                                    <input type="text" class="form-control" id="nomor_surat"
                                                        name="nomor_surat" required>
                                                </div>

                                                <!-- Penanggung Jawab -->
                                                <div class="col-md-6">
                                                    <label for="penanggung_jawab" class="form-label">Penanggung
                                                        Jawab</label>
                                                    <input type="text" class="form-control" id="penanggung_jawab"
                                                        name="penanggung_jawab" required>
                                                </div>

                                                <!-- Jenis Surat -->
                                                <div class="col-md-6">
                                                    <label for="jenis_surat" class="form-label">Jenis Surat</label>
                                                    <select class="form-select" id="jenis_surat" name="jenis_surat"
                                                        required>
                                                        <option value="Permohonan Izin Kegiatan">Permohonan Izin Kegiatan
                                                        </option>
                                                        <option value="Proposal Permohonan Dana">Proposal Permohonan Dana
                                                        </option>
                                                        <option value="Peminjaman Ruangan">Peminjaman Ruangan</option>
                                                        <option value="Peminjaman Kamera">Peminjaman Kamera</option>
                                                    </select>
                                                </div>

                                                <!-- File Surat -->
                                                <div class="col-md-6">
                                                    <label for="file_surat" class="form-label">File Surat</label>
                                                    <input type="file" class="form-control" id="file_surat"
                                                        name="file_surat">
                                                    <small id="current_file_surat" class="form-text text-muted">
                                                        File saat ini: <a href="#" target="_blank"
                                                            id="file_surat_link">Lihat File</a>
                                                    </small>
                                                </div>

                                                {{-- <!-- Status -->
                                                <div class="col-md-6">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select class="form-select" id="status" name="status" required>
                                                        <option value="Diproses">Diproses</option>
                                                        <option value="Ditolak">Ditolak</option>
                                                        <option value="Disetujui">Disetujui</option>
                                                        <option value="Selesai">Selesai</option>
                                                    </select>
                                                </div> --}}
                                            </div>
                                            <div class="mt-3 text-end">
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
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
                                            Konfirmasi Pembatalan Pengajuan Surat
                                        </h5>
                                    </div>
                                    <div class="modal-body text-center" style="padding: 20px;">
                                        <p>Apakah Anda yakin ingin membatalkan Pengajuan Surat ini?</p>
                                    </div>
                                    <div class="modal-footer" style="border: none; justify-content: center;">
                                        <form id="deleteForm" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                style="padding: 10px 30px;">Iya</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            style="padding: 10px 30px;">Kembali</button>
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

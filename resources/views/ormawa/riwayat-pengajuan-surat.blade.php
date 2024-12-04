@extends('template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div style="max-width: 100%; margin: 0 auto; padding: 10px;">
                        <h1 class="fs-4 fw-bold mb-4 text-center">Riwayat Pengajuan Surat</h1>

                        {{-- Filter dan Pencarian --}}
                        <div class="d-flex justify-content-end mb-3"
                            style="position: relative; display: flex; margin-bottom: 1rem;">
                            <form method="GET" class="justify-content-end"
                                style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: center;">
                                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                                    style="padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">

                                <select name="jenis_surat"
                                    style="padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px; width: 15%;">
                                    <option value="">Jenis Surat</option>
                                    <option value="Permohonan Izin Kegiatan"
                                        {{ request('jenis_surat') == 'Permohonan Izin Kegiatan' ? 'selected' : '' }}>
                                        Permohonan Izin Kegiatan
                                    </option>
                                    <option value="Proposal Permohonan Dana"
                                        {{ request('jenis_surat') == 'Proposal Permohonan Dana' ? 'selected' : '' }}>
                                        Proposal Permohonan Dana
                                    </option>
                                    <option value="Peminjaman Ruangan"
                                        {{ request('jenis_surat') == 'Peminjaman Ruangan' ? 'selected' : '' }}>
                                        Peminjaman Ruangan
                                    </option>
                                    <option value="Peminjaman Kamera"
                                        {{ request('jenis_surat') == 'Peminjaman Kamera' ? 'selected' : '' }}>
                                        Peminjaman Kamera
                                    </option>
                                </select>

                                <select name="status" style="padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                                    <option value="">Status</option>
                                    <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>
                                        Diproses</option>
                                    <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak
                                    </option>
                                    <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>
                                        Disetujui</option>
                                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>

                                <select name="sort" style="padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru
                                    </option>
                                    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama
                                    </option>
                                </select>

                                <button type="submit" class="btn btn-primary"
                                    style="padding: 0.5rem 1rem; border: none; border-radius: 4px; cursor: pointer;">
                                    Filter
                                </button>
                                <a href="{{ route('ormawa.riwayat-pengajuan-surat') }}" class="btn btn-danger"
                                    style="padding: 0.5rem 1rem; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; text-align: center;">
                                    Reset
                                </a>
                            </form>
                        </div>

                        {{-- Tabel Riwayat --}}
                        @if ($riwayat_pengajuan_surats->isEmpty())
                            <div class="alert alert-warning">
                                Belum ada data Riwayat Pengajuan Surat.
                            </div>
                        @else
                            {{-- <div class="table-responsive">
                                <table class="table datatable">
                                    <thead> --}}
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
                                            <th class="table-cell">Penanggung Jawab</th>
                                            <th class="table-cell">File Surat</th>
                                            <th class="table-cell">Nominal Dana yang Diajukan</th>
                                            <th class="table-cell">Status</th>
                                            <th class="table-cell">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayat_pengajuan_surats as $dt)
                                            <tr>
                                                <td class="table-cell">{{ $loop->iteration }}</td>
                                                <td class="table-cell">
                                                    {{ Carbon\Carbon::parse($dt->tanggal_diajukan)->translatedFormat('d F Y') }}
                                                </td>
                                                <td class="table-cell">{{ $dt->nomor_surat }}</td>
                                                <td class="table-cell">{{ $dt->jenis_surat }}</td>
                                                <td class="table-cell">{{ $dt->nama_kegiatan }}</td>
                                                <td class="table-cell">{{ $dt->penanggung_jawab }}</td>
                                                <td class="table-cell">
                                                    <a href="{{ asset('storage/' . $dt->file_surat) }}" target="_blank"
                                                        class="btn btn-info" style="padding: 2px 10px">
                                                        <i class="bi bi-file-earmark-pdf"></i>File</a>
                                                </td>
                                                <td class="table-cell">
                                                    {{ $dt->nominal_dana !== null ? 'Rp ' . number_format($dt->nominal_dana, 0, ',', '.') : '-' }}
                                                </td>
                                                <td class="table-cell">
                                                    <span
                                                        class="{{ $dt->status == 'Disetujui' || $dt->status == 'Selesai' ? 'status-finish' : ($dt->status == 'Ditolak' ? 'status-tolak' : 'status-pending') }}">
                                                        {{ $dt->status }}
                                                    </span>
                                                </td>
                                                <td class="table-cell">
                                                    @if ($dt->status === 'Disetujui' || $dt->status === 'Ditolak')
                                                        <a href="{{ route('ormawa.detail-riwayat-pengajuan-surat', $dt->id) }}"
                                                            class="btn btn-sm btn-primary d-flex justify-content-center">
                                                            Lihat
                                                        </a>
                                                    @else
                                                        <a href="{{ route('ormawa.detail-riwayat-pengajuan-surat', $dt->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            Lihat
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-warning"
                                                            data-id="{{ $dt->id }}">Edit</a>
                                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal"
                                                            onclick="setDeleteData('{{ $dt->id }}')">Batal</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                const editButtons = document.querySelectorAll('.btn-warning');
                                const editForm = document.getElementById('editForm');
                                const tanggalDiajukanInput = document.getElementById('tanggal_diajukan');
                                const nomorSuratInput = document.getElementById('nomor_surat');
                                const jenisSuratInput = document.getElementById('jenis_surat');
                                const namaKegiatanInput = document.getElementById('nama_kegiatan');
                                const penanggungJawabInput = document.getElementById('penanggung_jawab');
                                const fileSuratLink = document.getElementById('file_surat_link');
                                const nominalDanaInput = document.getElementById('nominal_dana');
                                const statusInput = document.getElementById('status');

                                // Tambahkan event listener untuk Jenis Surat
                                function toggleNominalDana() {
                                    if (jenisSuratInput.value === 'Proposal Permohonan Dana') {
                                        nominalDanaInput.disabled = false;
                                        nominalDanaInput.required = true;
                                    } else {
                                        nominalDanaInput.disabled = true;
                                        nominalDanaInput.required = false;
                                        nominalDanaInput.value = '';
                                    }
                                }

                                jenisSuratInput.addEventListener('change', toggleNominalDana);

                                editButtons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        const row = this.closest('tr');
                                        const pengajuanId = this.getAttribute('data-id');

                                        // // Ambil tanggal dari tabel
                                        // const tanggalText = row.querySelector('td:nth-child(2)').textContent.trim();
                                        // const [day, month, year] = tanggalText.split(" ");
                                        // const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                                        //     "Agustus", "September", "Oktober", "November", "Desember"
                                        // ];
                                        // const monthNumber = months.indexOf(month) + 1;
                                        // const formattedTanggal =
                                        //     `${year}-${monthNumber.toString().padStart(2, '0')}-${day.padStart(2, '0')}`;
                                        // tanggalDiajukanInput.value = formattedTanggal; // Format to YYYY-MM-DD

                                        // Ambil data dari tabel
                                        const nomorSurat = row.querySelector('td:nth-child(3)').textContent.trim();
                                        const jenisSurat = row.querySelector('td:nth-child(4)').textContent.trim();
                                        const namaKegiatan = row.querySelector('td:nth-child(5)').textContent.trim();
                                        const penanggungJawab = row.querySelector('td:nth-child(6)').textContent.trim();
                                        const fileSurat = row.querySelector('td:nth-child(7)').querySelector('a').href;
                                        const nominalDana = row.querySelector('td:nth-child(8)').textContent.trim();
                                        // // Ambil status surat
                                        // const status = row.querySelector('td:nth-child(9)').textContent.trim()

                                        // // Cek status surat
                                        // if (status === 'Disetujui' || status === 'Ditolak') {
                                        //     // Tampilkan pop-up jika surat sudah disetujui atau ditolak
                                        //     showModal('Surat tidak dapat diedit karena sudah ' + status.toLowerCase() +
                                        //         '. Silakan ajukan ulang.');
                                        //     return; // Hentikan eksekusi lebih lanjut
                                        // }

                                        // Perbaikan: Ubah cara pengambilan data penanggung jawab dan file surat
                                        nomorSuratInput.value = nomorSurat;
                                        jenisSuratInput.value = jenisSurat;
                                        namaKegiatanInput.value = namaKegiatan;
                                        penanggungJawabInput.value = penanggungJawab;
                                        fileSuratLink.href = fileSurat;
                                        nominalDanaInput.value = nominalDana;
                                        // statusInput.value = status;

                                        // Tambahkan pemeriksaan untuk mencegah kesalahan
                                        const editModal = new bootstrap.Modal(document.getElementById('editModal'));

                                        // Atur action form dengan ID pengajuan
                                        editForm.action = `/ormawa/edit-pengajuan-surat/${pengajuanId}`;

                                        // Tampilkan modal
                                        editModal.show();

                                        // Atur status input Nominal Dana berdasarkan Jenis Surat
                                        toggleNominalDana();
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
                                                {{-- <!-- Tanggal Diajukan -->
                                            <div class="col-md-6">
                                                <label for="tanggal_diajukan" class="form-label">Tanggal
                                                    Diajukan</label>
                                                <input type="date" class="form-control" id="tanggal_diajukan"
                                                    name="tanggal_diajukan" required readonly>
                                            </div> --}}

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

                                                <!-- Nominal Dana -->
                                                <div class="col-md-6">
                                                    <label for="nominal_dana" class="form-label">Nominal Dana yang
                                                        Diajukan</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Rp</span>
                                                        <input type="number" class="form-control" id="nominal_dana"
                                                            name="nominal_dana" placeholder="Masukkan nominal dana"
                                                            min="0">
                                                    </div>
                                                    <small class="form-text text-muted">Kosongkan jika tidak ada
                                                        dana</small>
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

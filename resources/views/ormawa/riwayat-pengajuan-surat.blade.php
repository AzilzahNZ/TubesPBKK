@extends('template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="justify-content-center text-align-center text-center fs-4 fw-bold mb-4"
                        style="margin-top: 10px;">Riwayat Pengajuan Surat</h1>

                    {{-- Tabel Riwayat --}}
                    @if ($riwayat_pengajuan_surats->isEmpty())
                        <div class="alert alert-warning">
                            Belum ada data Riwayat Pengajuan Surat.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Diajukan</th>
                                        <th>Nomor Surat</th>
                                        <th>Jenis Surat</th>
                                        <th>Nama Kegiatan</th>
                                        <th>PJ</th>
                                        <th>File Surat</th>
                                        <th>Nominal Dana yang Diajukan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayat_pengajuan_surats as $dt)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ Carbon\Carbon::parse($dt->tanggal_diajukan)->format('d F Y') }}</td>
                                            <td>{{ $dt->nomor_surat }}</td>
                                            <td>{{ $dt->jenis_surat }}</td>
                                            <td>{{ $dt->nama_kegiatan }}</td>
                                            <td>{{ $dt->penanggung_jawab }}</td>
                                            <td>
                                                <a href="{{ asset('storage/' . $dt->file_surat) }}" target="_blank"
                                                    class="btn btn-info" style="padding: 2px 10px">
                                                    <i class="bi bi-file-earmark-pdf"></i>File</a>
                                            </td>
                                            <td>
                                                {{ $dt->nominal_dana !== null ? 'Rp ' . number_format($dt->nominal_dana, 0, ',', '.') : '-' }}
                                            </td>
                                            <td>
                                                <span
                                                    class="{{ $dt->status == 'Selesai' ? 'status-finish' : 'status-pending' }}">{{ $dt->status }}</span>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-warning" data-id="{{ $dt->id }}">Edit</a>
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
                                                <select class="form-select" id="jenis_surat" name="jenis_surat" required>
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

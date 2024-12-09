@extends('template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div style="max-width: 100%; margin: 0 auto; padding: 10px;">
                        <h1 class="fs-4 fw-bold mb-4 text-center">Riwayat Surat</h1>

                        {{-- Filter dan Pencarian --}}
                        <div class="d-flex justify-content-between mb-3"
                            style="position: relative; display: flex; margin-bottom: 1rem;">
                            <div class="justify-content-start">
                                <!-- Bagian Tampilkan -->
                                <form method="GET" class="d-flex justify-content-start align-items-center">
                                    <label for="per_page" class="me-2">Tampilkan</label>
                                    <select name="per_page" id="per_page" class="form-select me-3" style="width: auto;"
                                        onchange="this.form.submit()">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                    </select>
                                </form>
                            </div>
                            <form method="GET" class="justify-content-end" style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: center;">
                                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                                    style="padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">

                                <select name="kategori"
                                    style="padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                                    <option value="">Kategori</option>
                                    <option value="Surat Masuk"
                                        {{ request('kategori') == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                                    <option value="Surat Keluar"
                                        {{ request('kategori') == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                                </select>

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
                                <a href="{{ route('riwayat-surat') }}" class="btn btn-danger"
                                    style="padding: 0.5rem 1rem; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; text-align: center;">
                                    Reset
                                </a>
                            </form>
                        </div>

                        {{-- Tabel Riwayat --}}
                        @if ($riwayat_surats->isEmpty())
                            <div class="alert alert-warning">
                                Belum ada data Riwayat Surat.
                            </div>
                        @else
                            <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; margin-bottom: 20px;">
                                <table
                                    style="width: 100%; border-collapse: collapse; border: 1px solid #ddd; white-space: nowrap;">
                                    <thead>
                                        <tr class="table-header">
                                            <th class="table-cell text-center">No</th>
                                            <th class="table-cell text-center" style="text-align: center;">Pengirim</th>
                                            <th class="table-cell text-center">Tanggal Surat<br>Masuk/Keluar</br></th>
                                            <th class="table-cell text-center">Kategori</th>
                                            <th class="table-cell text-center">Nomor Surat</th>
                                            <th class="table-cell text-center">Jenis Surat</th>
                                            <th class="table-cell text-center">Status</th>
                                            <th class="table-cell text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayat_surats as $dt)
                                            <tr>
                                                <td class="table-cell">{{ $loop->iteration + ($riwayat_surats->currentPage() - 1) * $riwayat_surats->perPage() }}</td>
                                                <td class="table-cell">
                                                    {{ $dt->nama_pengirim ?? 'Unknown' }}</td>
                                                <td class="table-cell">
                                                    {{ Carbon\Carbon::parse($dt->tanggal_surat_masuk_keluar)->translatedFormat('d F Y') }}
                                                </td>
                                                <td class="table-cell">{{ $dt->kategori }}</td>
                                                <td class="table-cell">{{ $dt->nomor_surat }}</td>
                                                <td class="table-cell">{{ $dt->jenis_surat }}</td>
                                                <td class="table-cell">
                                                    <span class="{{ $dt->status == 'Disetujui' || $dt->status == 'Selesai' ? 'status-finish' : ($dt->status == 'Ditolak' ? 'status-tolak' : '') }}">
                                                        {{ $dt->status }}
                                                    </span>                                                    
                                                </td>
                                                <td class="justify-content-center" style="padding: 12px; border-bottom: 1px solid #ddd;">
                                                    <a class="justify-content-center" href="{{ route('detail-riwayat-surat', $dt->id) }}"
                                                        class="btn btn-sm btn-primary"
                                                        style="padding: 6px 12px; text-decoration: none; color: white; background-color: #007bff; border-radius: 4px;">
                                                        Lihat
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="d-flex justify-content-center mt-3">
                            {{ $riwayat_surats->links('pagination::bootstrap-4') }}
                        </div> 

                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                const editButtons = document.querySelectorAll('.btn-warning'); // Tombol Edit
                                const editForm = document.getElementById('editForm'); // Formulir di modal
                                const tanggalDiajukanInput = document.getElementById('tanggal_diajukan'); // Input Tanggal Diajukan
                                const nomorSuratInput = document.getElementById('nomor_surat'); // Input Nomor Surat
                                const kategori = document.getElementById('kategori'); // Input Kategori Surat
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
                                        const kategori = row.querySelector('td:nth-child(4)').textContent
                                            .trim(); // Ambil Kategori Surat
                                        const jenisSurat = row.querySelector('td:nth-child(5)').textContent
                                            .trim(); // Ambil Jenis Surat
                                        const namaKegiatan = row.querySelector('td:nth-child(6)').textContent
                                            .trim(); // Ambil Nama Kegiatan
                                        const penanggungJawab = row.querySelector('td:nth-child(7)').textContent
                                            .trim(); // Ambil Penanggung Jawab
                                        const fileSuratPath = row.querySelector('td:nth-child(8)').getAttribute(
                                            'href'); // Ambil Link File Surat

                                        // Isi form dengan data lama
                                        // tanggalDiajukanInput.value = tanggalDiajukan; // Isi Tanggal Diajukan
                                        nomorSuratInput.value = nomorSurat; // Isi Nomor Surat
                                        kategoriInput.value = kategori; // Isi Kategori Surat
                                        jenisSuratInput.value = jenisSurat; // Isi Jenis Surat
                                        namaKegiatanInput.value = namaKegiatan; // Isi Nama Kegiatan
                                        penanggungJawabInput.value = penanggungJawab; // Isi Penanggung Jawab
                                        fileSuratLink.href = fileSuratPath; // Tampilkan Link File Surat
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
                                deleteForm.action = `/riwayat-surat/${id}`;
                            };
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

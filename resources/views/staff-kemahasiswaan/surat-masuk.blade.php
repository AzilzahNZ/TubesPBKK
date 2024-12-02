@extends('template')

@section('content')
    <div class="card card-body" style="max-width: 100%; margin: 0 auto; padding: 10px;">
        <h1 class="justify-content-center text-align-center text-center"
            style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">
            Surat Masuk
        </h1>

        {{-- Filter dan Pencarian --}}
        <div class="d-flex justify-content-end mb-3" style="position: relative; display: flex; justify-content: end; margin-bottom: 1rem;">
            <form method="GET" class="justify-content-end" style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: center;">
                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                    style="padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">

                <select name="jenis_surat" style="padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px; width: 15%;">
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
                    <option value="Peminjaman Kamera" {{ request('jenis_surat') == 'Peminjaman Kamera' ? 'selected' : '' }}>
                        Peminjaman Kamera
                    </option>
                </select>

                <select name="status" style="padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">Status</option>
                    <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>
                        Diproses</option>
                    <option value="Direvisi" {{ request('status') == 'Direvisi' ? 'selected' : '' }}>
                        Direvisi</option>
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
                <a href="{{ route('staff-kemahasiswaan.surat-masuk') }}" class="btn btn-danger"
                    style="padding: 0.5rem 1rem; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; text-align: center;">
                    Reset
                </a>
            </form>
        </div>

        {{-- Tabel Riwayat --}}
        @if ($surat_masuks->isEmpty())
            <div class="alert alert-warning" role="alert" style="text-align: center;">
                Belum ada data Surat Masuk.
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
                                    <th style="padding: 10px; text-align: center; border-bottom: 1px solid #ddd;">
                                        No</th>
                                    <th style="padding: 10px; text-align: center; border-bottom: 1px solid #ddd;">
                                        Tanggal Diajukan</th>
                                    <th style="padding: 10px; text-align: center; border-bottom: 1px solid #ddd;">
                                        Nomor Surat</th>
                                    <th style="padding: 10px; text-align: center; border-bottom: 1px solid #ddd;">
                                        Jenis Surat</th>
                                    <th style="padding: 10px; text-align: center; border-bottom: 1px solid #ddd;">
                                        Nama Kegiatan</th>
                                    <th style="padding: 10px; text-align: center; border-bottom: 1px solid #ddd;">
                                        Status
                                    </th>
                                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surat_masuks as $dt)
                                    <tr>
                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                            {{ $loop->iteration }}</td>
                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                            {{ $dt->tanggal_diajukan? \Carbon\Carbon::parse($dt->tanggal_diajukan)->timezone('Asia/Jakarta')->translatedFormat('d F Y'): '-' }}
                                        </td>
                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                            {{ $dt->nomor_surat }}</td>
                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                            {{ $dt->jenis_surat }}</td>
                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                            {{ $dt->nama_kegiatan }}</td>
                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                            {{ $dt->status }}</td>
                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                            <a href="{{ route('staff-kemahasiswaan.detail-surat-masuk', $dt->id) }}">
                                                <a href="{{ route('staff-kemahasiswaan.detail-surat-masuk', $dt->id) }}"
                                                    class="btn btn-sm btn-primary"
                                                    style="padding: 6px 12px; text-decoration: none; color: white; background-color: #007bff; border-radius: 4px;">
                                                    Lihat
                                                </a>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                        const fileSuratPath = row.querySelector('td:nth-child(7)').getAttribute(
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
                deleteForm.action = `staff-kemahasiswaan.surat-masuk`;
            };
        </script>
    </div>
@endsection

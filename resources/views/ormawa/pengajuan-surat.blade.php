@extends('template')

@section('content')
    <form action="/ormawa/pengajuan-surat/store" method="POST" enctype="multipart/form-data" id="formPengajuanSurat" style="max-width: 800px; margin: auto; background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        @csrf
        <h1 class="justify-content-center text-align-center text-center"
            style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">
            Pengajuan Surat
        </h1>
        <div style="display: flex; gap: 20px;">
            <!-- Kolom Kiri -->
            <div style="flex: 1;">
                <div style="margin-bottom: 15px;">
                    <label for="tanggal_surat" style="display: block; font-weight: bold; margin-bottom: 5px;">
                        Tanggal Surat Diajukan</label>
                    <input type="date" id="tanggal_surat" name="tanggal_surat"
                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; height: 40px;"
                        readonly required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="nomor_surat" style="display: block; font-weight: bold; margin-bottom: 5px;">
                        Nomor Surat</label>
                    <input type="text" id="nomor_surat" name="nomor_surat"
                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; height: 40px;"
                        required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="jenis_surat" style="display: block; font-weight: bold; margin-bottom: 5px;">
                        Jenis Surat</label>
                    <select id="jenis_surat" name="jenis_surat"
                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; height: 40px;"
                        required>
                        <option value="">Pilih surat yang akan diajukan</option>
                        <option value="Permohonan Izin Kegiatan">Permohonan Izin Kegiatan</option>
                        <option value="Proposal Permohonan Dana">Proposal Permohonan Dana</option>
                        <option value="Peminjaman Ruangan">Peminjaman Ruangan</option>
                        <option value="Peminjaman Kamera">Peminjaman Kamera</option>
                    </select>
                </div>
            </div>
            <!-- Kolom Kanan -->
            <div style="flex: 1;">
                <div style="margin-bottom: 15px;">
                    <label for="nama_kegiatan" style="display: block; font-weight: bold; margin-bottom: 5px;">
                        Nama Kegiatan</label>
                    <input type="text" id="nama_kegiatan" name="nama_kegiatan"
                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; height: 40px;"
                        required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="penanggung_jawab" style="display: block; font-weight: bold; margin-bottom: 5px;">
                        Penanggung Jawab Kegiatan</label>
                    <input type="text" id="penanggung_jawab" name="penanggung_jawab"
                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; height: 40px;"
                        required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="file_surat" style="display: block; font-weight: bold; margin-bottom: 5px;">
                        Upload Surat</label>
                    <input type="file" id="file_surat" name="file_surat" accept=".pdf" max-size="2048"
                        style="display: block; padding: 6px; border: 1px solid #ccc; border-radius: 4px; height: 40px; width: 100%; line-height: normal; line-width: normal">
                    <small style="color: #666;">Format: .pdf</small>
                </div>
            </div>
        </div>
        <!-- Wrapper untuk tombol Kirim -->
        <div style="display: flex; justify-content: center; margin-top: 20px;">
            <button class="items-center justify-center" type="submit"
                style="width: 20%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;">Kirim</button>
        </div>
    </form>

    <script>
        // Mengisi input tanggal dengan tanggal hari ini
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date().toISOString().split('T')[0]; // Mengambil tanggal dalam format yyyy-mm-dd
            document.getElementById("tanggal_surat").value = today;
        });
    </script>
@endsection

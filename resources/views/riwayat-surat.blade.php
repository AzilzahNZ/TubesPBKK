@extends('template')

@section('content')
<<<<<<< HEAD:resources/views/riwayat-surat.blade.php
    <h1>Halaman Riwayat Surat</h1>
    <p>Ini adalah halaman Riwayat Surat</p>
@endsection
=======
<div class="container" style="max-width: 100%; margin: auto; background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <h1 class="justify-content-center text-align-center text-center" style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">
        Riwayat Persetujuan Surat
    </h1>

        <!-- Filter and Search -->
        <div class="d-flex justify-content-between mb-3 align-items-center">
            <div class="d-flex align-items-center" style="gap: 5px; width: 100%;">
                <!-- Search -->
                <form action="#" method="GET" style="width: 20%;">
                    <div class="d-flex align-items-center"
                        style="border: 1px solid #ced4da; border-radius: 5px; overflow: hidden;">
                        <input type="text" class="form-control border-0" placeholder="Search" name="query"
                            style="box-shadow: none; border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
                        <button type="submit" class="btn" style="background-color: #f8f9fa; border: none;">
                            <i class="bi bi-search" style="color: #ced4da;"></i>
                        </button>
                    </div>
                </form>

                <!-- Dropdown Filters -->
                <select class="form-select" style="flex: 1;">
                    <option selected>Jenis Surat</option>
                    <option value="1">Permohonan Izin Kegiatan</option>
                    <option value="2">Proposal Dana Kegiatan</option>
                </select>
                <select class="form-select" style="flex: 1;">
                    <option selected>Surat Masuk</option>
                    <option value="2">Surat Keluar</option>
                </select>
                <select class="form-select" style="width: 12%">
                    <option selected>Status</option>
                    <option value="1">Disetujui</option>
                    <option value="2">Ditolak</option>
                </select>
                <select class="form-select" style="flex: 1;">
                    <option selected>Terbaru</option>
                    <option value="1">Terlama</option>
                </select>

                <!-- Buttons -->
                <div class="d-flex" style="gap: 5px;">
                    <button class="btn btn-primary">Filter</button>
                    <button class="btn btn-danger">Hapus Filter</button>
                </div>
            </div>
        </div>

        <!-- Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Nama Ormawa</th>
                    <th>Penanggung Jawab</th>
                    <th>Surat yang Diajukan</th>
                    <th>Tanggal Disetujui/Ditolak</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>ORMAWA1</td>
                    <td>MAHASISWA1</td>
                    <td>Permohonan Izin Kegiatan</td>
                    <td>Kamis, 31 Oktober 2024 15:18:11</td>
                    <td>Disetujui</td>
                    <td><a href="#" class="btn btn-info text-white">Lihat</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>ORMAWA2</td>
                    <td>MAHASISWA2</td>
                    <td>Proposal Dana Kegiatan</td>
                    <td>Kamis, 31 Oktober 2024 15:18:11</td>
                    <td>Disetujui</td>
                    <td><a href="#" class="btn btn-info text-white">Lihat</a></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
>>>>>>> 0d65e7cd09f99f2fb2eea85732002b5290fd79cd:resources/views/staff-kemahasiswaan/riwayat-surat.blade.php

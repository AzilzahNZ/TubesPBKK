@extends('template')

@section('content')
    <div class="card card-body" style="max-width: 100%; margin: 0 auto; padding: 10px;">
        <h1 class="justify-content-center text-align-center text-center"
            style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">
            Surat Masuk
        </h1>

        {{-- Filter dan Pencarian --}}
        <div class="d-flex justify-content-end mb-3">
            <form method="GET" class="d-flex gap-2 flex-wrap">
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
            <form method="GET" action="{{ route('riwayat-surat') }}" class="ms-2">
                <button type="submit" class="form-button form-button-danger">Hapus Filter</button>
            </form>
        </div>

        {{-- Tabel Riwayat --}}
        @if ($surat_masuks->isEmpty())
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
                                        PJ</th>
                                    <th style="padding: 10px; text-align: center; border-bottom: 1px solid #ddd;">
                                        Status
                                    </th>
                                    <th style="padding: 10px; text-align: center; border-bottom: 1px solid #ddd;">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($surat_masuks as $dt)
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
                                            {{ $dt->status }}</td>
                                        <td style="padding: 12px; border-bottom: 1px solid #ddd;">
                                            <a href="{{ route('staff-kemahasiswaan.detail-surat-masuk', $dt->id) }}"
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
                </table>
            </div>
        @endif
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection

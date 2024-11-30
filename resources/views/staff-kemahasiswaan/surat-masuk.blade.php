@extends('template')

@section('content')
    <div
        style="max-width: 100%; margin: auto; background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <h1 class="justify-content-center text-align-center text-center"
            style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">
            Surat Masuk
        </h1>

        {{-- Filter dan Pencarian --}}
        <div class="d-flex justify-content-between mb-3 align-items-center" style="width: 100%; gap: 5px;">
            <form method="GET" action="{{ route('staff-kemahasiswaan.surat-masuk') }}"
                style="display: flex; gap: 5px; flex-wrap: wrap; width: 100%;">
                <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                    style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">

                <select name="jenis_surat" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
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
                    <option value="Peminjaman Kamera" {{ request('jenis_surat') == 'Peminjaman Kamera' ? 'selected' : '' }}>
                        Peminjaman
                        Kamera</option>
                </select>

                <select name="sort" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru
                    </option>
                    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama
                    </option>
                </select>

                <button type="submit"
                    style="padding: 8px 16px; background-color: #0d6efd; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    Filter
                </button>
                <div>
                    <form method="GET" action="{{ route('staff-kemahasiswaan.surat-masuk') }}">
                        <button type="submit"
                            style="padding: 10px 16px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">
                            Hapus Filter
                        </button>
                    </form>
                </div>
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
                                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                        No</th>
                                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                        Tanggal Diajukan</th>
                                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                        Nomor Surat</th>
                                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                        Jenis Surat</th>
                                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                        Nama Kegiatan</th>
                                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                        PJ</th>
                                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">
                                        Status
                                    </th>
                                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;"> 
                                        Tanggal Diedit
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
                                            {{ $dt->tanggal_diedit ? \Carbon\Carbon::parse($dt->tanggal_diedit)->timezone('Asia/Jakarta')->format('d M Y H:i') : '-' }}
                                        </td>                                                                                        
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
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection

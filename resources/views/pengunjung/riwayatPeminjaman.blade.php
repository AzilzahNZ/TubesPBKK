@extends('template')

@section('content')
<div class="row">
  <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title">Daftar Pengunjung</h5>
              <div class="table-responsive">
                  <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pengunjung</th>
                      <th>Judul Buku</th>
                      <th>Tanggal Peminjaman</th>
                      <th>Tanggal Pengembalian</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($peminjamans as $peminjaman)
                        <tr>
                            <td>{{ $peminjaman->pengunjung->nama }}</td>
                            <td>{{ $peminjaman->Katalog_Buku->judul }}</td>
                            <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                            <td>{{ $peminjaman->tanggal_pengembalian }}</td>
                            <td>{{ $peminjaman->status }}</td>
                            <td>
                                <a href="{{ route('peminjamans.show', $peminjaman->id) }}" class="btn btn-info">Detail</a>
                                <a href="{{ route('peminjamans.edit', $peminjaman->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('peminjamans.destroy', $peminjaman->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus peminjaman ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
          </div>
      </div>
  </div>
    </div>
  </div>
@endsection

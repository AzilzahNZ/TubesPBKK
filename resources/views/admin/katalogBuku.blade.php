@extends('template')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Katalog Buku</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Cover</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Genre</th>
                            <th>Sinopsis</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($katalog__bukus as $buku)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="asset{{ ('$buku->cover') }}" alt="Cover" width="100">
                            </td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ $buku->penerbit }}</td>
                            <td>{{ $buku->tahun_terbit }}</td>
                            <td>{{ $buku->genre }}</td>
                            <td>{{ Str::limit($buku->sinopsis, 100) }}...</td>
                            <td>{{ $buku->stok }}</td>
                            <td>{{ $buku->status }}</td>
                            <td>
                                <button style=>
                                    <a href="{{route('edit', $buku->id)}}">Edit</a>
                                </button>
                                    <form action="{{route('destroy', $buku->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button style="color: red;">Hapus</button>
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
@endsection
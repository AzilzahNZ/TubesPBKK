@extends('template')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Daftar Akun Pengguna</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No HP</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @foreach($pengunjungs as $pengunjung)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pengunjung->user->name }}</td>
                                <td>{{ $pengunjung->user->email }}</td>
                                <td>{{ $pengunjung->no_hp }}</td>
                            </tr>
                            @endforeach
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

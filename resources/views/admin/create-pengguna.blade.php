@extends('template')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" style="font-weight: bold; text-align: center;">Tambah Akun Pengguna</h5>

                <!-- Menampilkan pesan sukses jika ada -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Form untuk menambahkan akun pengguna baru -->
                <form action="{{ route('admin.store-pengguna') }}" method="POST">
                    @csrf
                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <!-- No. Telepon -->
                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" required>
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select type="text" class="form-control" id="role" name="role" required>
                            <option value="">Pilih pengguna sebagai apa</option>
                            <option value="admin">admin</option>
                            <option value="ormawa">ormawa</option>
                            <option value="staff-kemahasiswaan">staff-kemahasiswaan</option>
                            <option value="staff-tu">staff-tu</option>
                        </select>
                    </div>

                    <!-- Tombol Kirim -->
                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

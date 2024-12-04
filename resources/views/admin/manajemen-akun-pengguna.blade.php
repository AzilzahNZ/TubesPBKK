@extends('template')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div style="max-width: 100%; margin: 0 auto; padding: 10px;">
                        <h1 class="fs-4 fw-bold mb-4 text-center">Daftar Akun Pengguna</h1>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('admin.create-pengguna') }}" class="btn btn-primary">Tambah</a>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <!-- Bagian Tampilkan -->
                            <form method="GET" class="d-flex align-items-center">
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
                        <div>
                            <!-- Bagian Cari -->
                            <form method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control me-2" placeholder="Cari..."
                                    value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; margin-bottom: 20px; padding: 20px;">
                    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd; white-space: nowrap;">
                        <thead>
                            <tr class="table-header">
                                <th class="table-cell text-center">No</th>
                                <th class="table-cell text-center">Username</th>
                                <th class="table-cell text-center">Email</th>
                                <th class="table-cell text-center">No. Telepon</th>
                                <th class="table-cell text-center">Role</th>
                                <th class="table-cell text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data yang ditemukan.</td>
                                </tr>
                            @else
                                @foreach ($users as $dt)
                                    <tr>
                                        <td class="table-cell">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                        <td class="table-cell">{{ $dt->name }}</td>
                                        <td class="table-cell">{{ $dt->email }}</td>
                                        <td class="table-cell">{{ $dt->no_telepon }}</td>
                                        <td class="table-cell">{{ $dt->role }}</td>
                                        <td class="table-cell">
                                            <!-- Tombol Edit -->
                                            <a class="btn btn-sm btn-warning" data-id="{{ $dt->id }}">Edit</a>
                                            <!-- Tombol Delete -->
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                onclick="setDeleteData('{{ $dt->id }}')">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <!-- Tabel Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $users->appends(['search' => request('search'), 'per_page' => request('per_page')])->links('pagination::bootstrap-4') }}
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const editButtons = document.querySelectorAll('.btn-warning'); // Tombol Edit
                            const editForm = document.getElementById('editForm'); // Formulir di modal
                            const usernameInput = document.getElementById('username');
                            const passwordInput = document.getElementById('password');
                            const emailInput = document.getElementById('email');
                            const noTeleponInput = document.getElementById('no_telepon');
                            const roleInput = document.getElementById('role');

                            // Event listener untuk tombol Edit
                            editButtons.forEach(button => {
                                button.addEventListener('click', function() {
                                    const row = this.closest('tr'); // Baris tabel pengguna
                                    const userId = this.getAttribute('data-id'); // Ambil ID pengguna
                                    const username = row.querySelector('td:nth-child(2)').textContent.trim();
                                    const email = row.querySelector('td:nth-child(3)').textContent.trim();
                                    const noTelepon = row.querySelector('td:nth-child(4)').textContent.trim();
                                    const role = row.querySelector('td:nth-child(5)').textContent.trim();

                                    // Isi form modal dengan data pengguna
                                    usernameInput.value = username;
                                    emailInput.value = email;
                                    noTeleponInput.value = noTelepon;
                                    roleInput.values = role;

                                    // Set action URL form dengan ID pengguna
                                    editForm.action = `/admin/edit-pengguna/${userId}`;

                                    // Tampilkan modal
                                    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                                    editModal.show();
                                });
                            });
                        });

                        function setDeleteData(id) {
                            const deleteForm = document.getElementById('deleteForm');
                            deleteForm.action = `/admin/delete-pengguna/${id}`;
                        }
                    </script>

                    <!-- Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <!-- Header Modal -->
                                <div class="modal-header" style="border: none;">
                                    <h5 class="modal-title w-100 text-center" id="editModalLabel"
                                        style="font-weight: bold; font-size: 1.25rem;">
                                        Edit Data Akun
                                    </h5>
                                    <!-- Tombol X -->
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <!-- Form Modal -->
                                <form id="editForm" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body" style="padding: 20px;">
                                        <!-- Username -->
                                        <div class="mb-3">
                                            <label for="username" class="form-label"
                                                style="font-weight: bold;">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                required style="border-radius: 5px;">
                                        </div>
                                        {{-- <!-- Password -->
                                            <div class="mb-3">
                                                <label for="password" class="form-label"
                                                    style="font-weight: bold;">Password</label>
                                                <input type="password" class="form-control" id="password" name="password"
                                                    style="border-radius: 5px;">
                                            </div> --}}
                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label"
                                                style="font-weight: bold;">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                required style="border-radius: 5px;">
                                        </div>
                                        <!-- No. Telepon -->
                                        <div class="mb-3">
                                            <label for="no_telepon" class="form-label" style="font-weight: bold;">No.
                                                Telepon</label>
                                            <input type="text" class="form-control" id="no_telepon" name="no_telepon"
                                                required style="border-radius: 5px;">
                                        </div>

                                        <!-- Role -->
                                        <div class="mb-3">
                                            <label for="role" class="form-label"
                                                style="font-weight: bold;">Role</label>
                                            <select type="text" class="form-control" id="role" name="role"
                                                required style="border-radius: 5px;">
                                                <option value="admin">admin</option>
                                                <option value="ormawa">ormawa</option>
                                                <option value="staff-kemahasiswaan">staff-kemahasiswaan</option>
                                                <option value="staff-tu">staff-tu</option>
                                            </select>
                                        </div>

                                    </div>
                                    <!-- Footer Modal -->
                                    <div class="modal-footer"
                                        style="border: none; justify-content: center; padding: 15px 0;">
                                        <button type="submit" class="btn btn-primary"
                                            style="padding: 10px 30px;">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Konfirmasi Delete -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header" style="border: none;">
                                    <h5 class="modal-title w-100 text-center" id="deleteModalLabel"
                                        style="font-weight: bold; font-size: 1.25rem;">
                                        Konfirmasi Hapus Akun
                                    </h5>
                                </div>
                                <div class="modal-body text-center" style="padding: 20px;">
                                    <p>Apakah Anda yakin ingin menghapus Akun ini?</p>
                                </div>
                                <div class="modal-footer" style="border: none; justify-content: center;">
                                    <form id="deleteForm" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            style="padding: 10px 30px;">Hapus</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        style="padding: 10px 30px;">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

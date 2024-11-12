@extends('template') 

@section('content')
<style>
    .card-img-top {
        height: 280px;
        object-fit: cover;
        display: block; /* Memastikan gambar sebagai block element */
        margin: 0 auto; /* Mengatur margin otomatis di kiri dan kanan */
        width: 80%; /* Mengatur lebar gambar menjadi 80% dari card */
        padding: 15px; /* Memberikan padding di sekitar gambar */
    }

    .card {
        transition: transform 0.3s;
        margin-bottom: 20px;
        height: 100%; /* Ensure consistent height */
        text-align: justify
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .card-body {
        text-align: justify;
    }

    .card-body p {
        margin-bottom: 0.5rem;
        font-size: 0.85rem;
        text-align: justify
    }

    /* Style untuk label (teks bold) agar rata kiri */
    .card-body p strong {
        display: inline-block;
        width: 100px; /* Menyesuaikan lebar label */
        text-align: left;
    }

    .btn-link {
        padding: 0;
        margin-top: 0.5rem;
        color: #007bff;
        text-decoration: none;
        display: block; /* Membuat tombol link menjadi block */
        align-items: center
    }

    .btn-link:hover {
        text-decoration: underline;
    }

    .btn-primary {
        margin-top: auto;
    }

    /* New styles for full-width layout */
    .full-width-container {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    .card-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        padding: 20px;
    }

    .card-footer {
        background-color: transparent; /* Menghapus background footer */
        border-top: none; /* Menghapus border footer */
        padding: 1rem;
        text-align: center; /* Mengatur tombol ke tengah */
    }

    /* Responsive adjustments */
    @media (max-width: 1200px) {
        .card-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 992px) {
        .card-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .card-grid {
            grid-template-columns: 1fr;
        }
        .card-img-top {
            width: 100%; /* Menyesuaikan lebar gambar untuk layar kecil */
        }
    }
</style>

<div class="full-width-container">
    <div class="card-grid">
        @foreach ($katalog__bukus as $buku)
            <div class="card">
                <img src="{{ asset('assets/img/cover1.jpg') }}" alt="Cover Buku {{ $buku->judul }}" class="card-img-top">
                <div class="card-body">
                    <p><strong>Judul</strong> {{ $buku->judul }}</p>
                    <p><strong>Penulis</strong> {{ $buku->penulis }}</p>
                    <p><strong>Penerbit</strong> {{ $buku->penerbit }}</p>
                    <p><strong>Tahun Terbit</strong> {{ $buku->tahun_terbit }}</p>
                    <p><strong>Genre</strong> {{ $buku->genre }}</p>
                    <p><strong>Stok</strong> {{ $buku->stok }}</p>

                    <div>
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#sinopsisModal{{ $buku->id }}">
                            Lihat Sinopsis
                        </button>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary w-100" onclick="window.location.href='{{ route('pengunjung.pinjam') }}'" style="color: white;">
                        Pinjam Buku
                    </button>
                </div>
            </div>

            <!-- Modal Sinopsis -->
            <div class="modal fade" id="sinopsisModal{{ $buku->id }}" tabindex="-1" aria-labelledby="sinopsisLabel{{ $buku->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="sinopsisLabel{{ $buku->id }}">{{ $buku->judul }} - Sinopsis</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-justify">
                            {{ $buku->sinopsis }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

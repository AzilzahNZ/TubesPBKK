@extends('template')

@section('content')
    <div class="row g-3">
        <div class="col-12">
            <div class="info-card sales-card">
                <div class="card text-center">
                    <div class="card-body">
                        <h3>Selamat Datang!</h3>
                        <h6>{{ Auth::user()->name }}</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="info-card sales-card">
                <div class="col-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5>Jumlah akun pengguna</h5>
                            <h6>{{ $totalUsers }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="info-card sales-card">
                <div class="col-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5>Jumlah akun ormawa</h5>
                            <h6>{{ $totalOrmawa }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Accordion FAQ -->
    <div class="mt-3">
        <div class="accordion" id="faqAccordion">
            <!-- Accordion Item 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="" aria-controls="collapseOne">
                        Apa itu SIMPULS?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        SIMPULS adalah Sistem Informasi Surat Menyurat Kegiatan ORMAWA Fakultas Teknik yang digunakan untuk
                        mempermudah proses pengajuan dan pengelolaan surat dari ORMAWA di Fakultas Teknik Universitas Bengkulu.
                    </div>
                </div>
            </div>
            <!-- Accordion Item 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Siapa saja yang dapat menggunakan SIMPULS?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        SIMPULS dapat digunakan oleh ORMAWA, Staff Tata Usaha, Staff Kemahasiswaan, dan Admin Fakultas
                        Teknik.
                    </div>
                </div>
            </div>
            <!-- Accordion Item 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Apa saja jenis surat yang dapat diajukan melalui SIMPULS?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        SIMPULS mendukung pengajuan Surat Permohonan Izin Kegiatan, Surat Proposal Permohonan Dana Kegiatan, Surat
                        Peminjaman Ruangan, dan Surat Peminjaman Kamera.
                    </div>
                </div>
            </div>
            <!-- Accordion Item 4 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Kode Surat untuk ORMAWA di Lingkungan Fakultas Teknik Universitas Bengkulu!
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>Badan Eksekutif Mahasiswa (BEM) Fakultas Teknik. Kode Surat : <span class="fw-bold">KM01</span></p>
                        <p>Dewan Legislatif Mahasiswa (DPM) Fakultas Teknik. Kode Surat : <span class="fw-bold">KM02</span></p>
                        <p>Himpunan Mahasiswa Teknik Informatika (HIMATIF). Kode Surat : <span class="fw-bold">KM03</span></p>
                        <p>Himpunan Mahasiswa Teknik Sipil (HMTS). Kode Surat : <span class="fw-bold">KM04</span></p>
                        <p>Himpunan Mahasiswa Teknik Mesin (HMM). Kode Surat : <span class="fw-bold">KM05</span></p>
                        <p>Himpunan Mahasiswa Teknik Elektro (HIMATRO). Kode Surat : <span class="fw-bold">KM06</span></p>
                        <p>Himpunan Mahasiswa Arsitektur(HMAR). Kode Surat : <span class="fw-bold">KM07</span></p>
                        <p>Himpunan Mahasiswa Sistem Informasi (HIMASIF). Kode Surat : <span class="fw-bold">KM08</span></p>
                        <p>UKM Moslem Station's of Engineering (MOSTANEER). Kode Surat : <span class="fw-bold">KM21</span></p>
                        <p>UKM Perkumpulan Konservasi Alam Teknik (PULKANIK). Kode Surat : <span class="fw-bold">KM22</span></p>
                        <p>UKM Engineering Research Community (ERCOM). Kode Surat : <span class="fw-bold">KM23</span></p>
                    </div>
                </div>
            </div>
            <!-- Accordion Item 5 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Bagaimana alur pengajuan surat melalui SIMPULS?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Pengajuan surat dimulai dari ORMAWA yang mengisi form data surat yang ingin diajukan pada menu "Pengajuan Surat", setelah mengisi form pada menu tersebut maka data akan ditampilkan pada menu "Riwayat Pengajuan Surat" dan dilanjutkan dengan menunggu persetujuan oleh Staff Kemahasiswaan.
                    </div>
                </div>
            </div>
            <!-- Accordion Item 6 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        Bagaimana jika surat yang diajukan Disetujui?
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Apabila pengajuan surat "Disetujui" maka status pengajuan surat akan berubah menjadi "Disetujui" dan akan segera dikirimkan notifikasi kepada ORMAWA terkait apabila surat balasan telah selesai.
                    </div>
                </div>
            </div>
            <!-- Accordion Item 7 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        Bagaimana jika surat yang diajukan Ditolak?
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Apabila pengajuan surat "Ditolak" maka status pengajuan surat akan berubah menjadi "Ditolak" dan akan dikirimkan alasan penolakannya, serta surat harus diajukan ulang.
                    </div>
                </div>
            </div>
            <!-- Accordion Item 8 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        Bagaimana jika pengguna lupa password Akun SIMPULS nya?
                    </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Apabila pengguna lupa password Akun SIMPULS nya maka dapat menghubungi Admin Fakultas Teknik (Hubungi nomor berikut : 0821-8502-6149).
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Accordion FAQ -->
@endsection

@extends('template')

@section('content')
    <!-- Sales Card -->
    <div class="col-xxl-12 col-md-6 ">
        <div class="card info-card sales-card ">

            <div class="card-body ">
                <h3 class="d-flex align-items-center justify-content-center"><br>Selamat Datang :)</h3>
                <div class="d-flex align-items-center justify-content-center">
                    <h6>{{ Auth::user()->name }}</h6>
                </div>
            </div>

        </div>
    </div><!-- End Sales Card -->

    <div class="d-flex align-items-center justify-content-center">
            <div class="col-lg-6 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center" style="margin-bottom: 10px;">
                            <h5><br>Riwayat Pengajuan Surat</h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <h5 class="me-3"><b>Diproses : {{ $totalStatusDiproses }}</b></h5>
                            <h5 class="me-3"><b>Disetujui : {{ $totalStatusDisetujui }}</b></h5>
                            <h5 class="me-3"><b>Ditolak : {{ $totalStatusDitolak }}</b></h5>
                            <h5><b>Selesai : {{ $totalStatusSelesai }}</b></h5>
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
                        SIMPULS adalah Sistem Informasi Surat Menyurat Kegiatan ORMAWA Teknik yang digunakan untuk
                        mempermudah proses pengajuan dan pengelolaan surat di Fakultas Teknik Universitas Bengkulu.
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
                        Apa jenis surat yang dapat diajukan melalui SIMPULS?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        SIMPULS mendukung pengajuan Surat Permohonan Izin Kegiatan, Surat Proposal Dana Kegiatan, dan Surat
                        Peminjaman Ruangan.
                    </div>
                </div>
            </div>
            <!-- Accordion Item 4 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Bagaimana alur pengajuan surat melalui SIMPULS?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Pengajuan surat dimulai dari ORMAWA yang mengisi data surat, dilanjutkan dengan persetujuan oleh
                        Staff Tata Usaha, dan akhirnya diverifikasi oleh Staff Kemahasiswaan.
                    </div>
                </div>
            </div>
            <!-- Accordion Item 5 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Apakah SIMPULS dapat diakses di luar kampus?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Ya, SIMPULS dirancang agar dapat diakses secara online dari mana saja dengan menggunakan kredensial
                        login yang valid.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Accordion FAQ -->
@endsection

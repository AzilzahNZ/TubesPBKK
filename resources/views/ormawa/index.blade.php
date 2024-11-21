@extends('template')

@section('content')
    <h1>Halaman Ormawa</h1>
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
@endsection

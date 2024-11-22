@extends('template')

@section('content')
    <h1>Dashboard</h1>
                <!-- Sales Card -->
                <div class="col-xxl-12 col-md-6 ">
                    <div class="card info-card sales-card ">
      
                      <div class="card-body ">
                        <h3 class="d-flex align-items-center justify-content-center"><br>Selamat Datang :)</h3>
                          <div class="d-flex align-items-center justify-content-center">
                            <h6 >{{ Auth::user()->name }}</h6>
                          </div>
                      </div>
      
                    </div>
                </div><!-- End Card -->

                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h5><br>Jumlah akun pengguna</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <h5><b>{{ $totalUsers }}</b></h5>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Card -->
                
                    <div class="col-lg-6 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h5><br>Jumlah akun ormawa</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <h5><b>{{ $totalOrmawa }}</b></h5>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Card -->
                </div>
@endsection

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
      
        <title>Dashboard - NiceAdmin Bootstrap Template</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
      
        <!-- Favicons -->
        <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
      
        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
      
        <!-- Vendor CSS Files -->
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
      
        <!-- Template Main CSS File -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
      </head>

        <body>
        <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-6 offset-md-3" style="height: 100vh; margin-top: 100px">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-center">Form Peminjaman Buku</h3>
                                <p class="text-center mb-4">Isi form di bawah ini untuk mendaftar meminjam buku</p>
                                
                                <form action="/route-ke-controller-pendaftaran" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="nama_pembeli">Nama</label>
                                        <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email_pembeli">Judul Buku</label>
                                        <input type="text" class="form-control" id="email_pembeli" name="email_pembeli" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tanggal_webinar">Tanggal Peminjaman</label>
                                        <input type="date" class="form-control" id="tanggal_webinar" name="tanggal_webinar" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tanggal_webinar">Tanggal Pengembalian</label>
                                        <input type="date" class="form-control" id="judul_webinar" name="judul_webinar" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="pemateri">Status</label>
                                        <input type="text" class="form-control" id="pemateri" name="pemateri" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
    
 
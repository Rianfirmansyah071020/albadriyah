<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Albadriyah Wisata - Formulir Pendaftaran</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/fav.png" rel="icon">
  <link href="assets/img/apple-touch.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/js/jquery-3.4.1.js"></script>

  <!-- =======================================================
  * Template Name: BizPage - v5.8.0
  * Template URL: https://bootstrapmade.com/bizpage-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container-fluid">

      <div class="row justify-content-center align-items-center">
        <div class="col-xl-11 d-flex align-items-center justify-content-between">
          <h1 class="logo"><a href="index">Albadriyah</a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto active" href="index#hero">Home</a></li>
              <li><a class="nav-link scrollto" href="index#about">Tentang Kami</a></li>
              <!--<li><a class="nav-link scrollto" href="#services">Layanan</a></li>-->
              <li><a class="nav-link scrollto " href="index#portfolio">Info Paket</a></li>
              <li><a class="nav-link scrollto" href="index#contact">Kontak</a></li>
              <li><a class="nav-link  " href="daftar">Daftar</a></li>
              <li><a class="nav-link  " href="user/login">Login</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->
        </div>
      </div>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>PENDAFTARAN</h2>
          <ol>
            <li><a href="index#hero">Home</a></li>
            <li>Daftar</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="inner-page mt-4">
      <div class="container">
        <?php
        include 'includes/koneksi.php';

        $ambil = mysqli_query($kon, "SELECT max(no_registrasi) as kodeTerbesar FROM pendaftaran");
        $data = mysqli_fetch_array($ambil);
        $kodereg = $data['kodeTerbesar'];

        // mengambil angka dari nomor terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($kodereg, 3, 3);

        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;

        // membentuk nomor registrasi baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = "REG";
        $kodereg = $huruf . sprintf("%03s", $urutan);

        ?>

        <form action="simpan.php" method="post" enctype="multipart/form-data">
          <!-- rows -->
          <div class="row">
            <div class="col-12">
              <div class="text-center">
                <img src="assets/img/logo2.png" class="img-fluid" alt="Responsive image">
              </div><br />
              <h2 class="text-center font-weight-bold">FORMULIR PENDAFTARAN</h2><br />
              <?php
              //Validasi untuk menampilkan pesan pemberitahuan
              if (isset($_GET['add'])) {

                if ($_GET['add'] == 'berhasil') {
                  echo "<script>alert('Selamat! Pendaftaran Berhasil. Terima Kasih Sudah Bergabung Bersama Al-Badriyah.');window.location='daftar'</script>";
                } else if ($_GET['add'] == 'gagal') {
                  echo "<script>alert('Maaf! Pendaftaran Gagal. Mohon Untuk Menghubungi CS Kami. Terima Kasih.');window.location='daftar'</script>";
                }
              }

              if (isset($_GET['hapus'])) {

                if ($_GET['hapus'] == 'berhasil') {
                  echo "<div class='alert alert-success'><strong>Berhasil!</strong> File gambar telah dihapus!</div>";
                } else if ($_GET['hapus'] == 'gagal') {
                  echo "<div class='alert alert-danger'><strong>Gagal!</strong> File gambar gagal dihapus!</div>";
                }
              }
              ?>
              <div class="form-group">
                <label for="noreg">No. Registrasi</label>
                <input type="text" class="form-control" id="noreg" name="noreg" value="<?php echo $kodereg ?>" readonly>
              </div>
              <div class="form-group">
                <label for="namalkp">Nama Lengkap</label>
                <input type="text" class="form-control" id="namalkp" name="namalkp" placeholder="Nama Lengkap">
              </div>
              <div class="form-group">
                <label for="tmplhr">Tempat Lahir</label>
                <input type="text" class="form-control" id="tmplhr" name="tmplhr" placeholder="Tempat Lahir">
              </div>
              <div class="form-group">
                <label for="tgllhr">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tgllhr" name="tgllhr" placeholder="Tanggal Lahir">
              </div>
              <div class="form-group">
                <label for="jekel">Jenis Kelamin</label>
                <select name="jekel" id="jekel" class="form-control">
                  <option disabled="disabled" selected="selected">Pilih</option>
                  <option>Pria</option>
                  <option>Wanita</option>
                </select>
              </div>
              <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" placeholder="Nomor Induk Kependudukan">
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat Lengkap"></textarea>
              </div>
              <div class="form-group">
                <label for="kota">Kabupaten/Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" placeholder="Kapupaten/Kota">
              </div>
              <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <select name="provinsi" id="provinsi" class="form-control">
                  <option disabled="disabled" selected="selected">Pilih Provinsi</option>
                  <option>Nanggroe Aceh Darussalam</option>
                  <option>Sumatera Utara</option>
                  <option>Sumatera Selatan</option>
                  <option>Sumatera Barat</option>
                  <option>Bengkulu</option>
                  <option>Riau</option>
                  <option>Kepulauan Riau</option>
                  <option>Jambi</option>
                  <option>Lampung</option>
                  <option>Bangka Belitung</option>
                  <option>Kalimantan Timur</option>
                  <option>Kalimantan Barat</option>
                  <option>Kalimantan Tengah</option>
                  <option>Kalimantan Selatan</option>
                  <option>Kalimantan Utara</option>
                  <option>DKI Jakarta</option>
                  <option>Banten</option>
                  <option>Jawa Barat</option>
                  <option>Jawa Tengah</option>
                  <option>DI Yogyakarta</option>
                  <option>Jawa Timur</option>
                  <option>Bali</option>
                  <option>Nusa Tenggara Barat</option>
                  <option>Nusa Tenggara Timur</option>
                  <option>Sulawesi Utara</option>
                  <option>Sulawesi Barat</option>
                  <option>Sulawesi Tengah</option>
                  <option>Gorontalo</option>
                  <option>Sulawesi Tenggara</option>
                  <option>Sulawesi Selatan</option>
                  <option>Maluku</option>
                  <option>Maluku Utara</option>
                  <option>Papua</option>
                  <option>Papua Barat</option>
                  <option>Papua Selatan</option>
                  <option>Papua Tengah</option>
                  <option>Papua Pegunungan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="kodepos">Kode Pos</label>
                <input type="text" class="form-control" id="kodepos" name="kodepos" placeholder="Kode Pos">
              </div>
              <div class="form-group">
                <label for="emailp">Email</label>
                <input type="email" class="form-control" id="emailp" name="emailp" placeholder="Email">
              </div>
              <div class="form-group">
                <label for="telp">Telpon Rumah</label>
                <input type="text" class="form-control" id="telp" name="telp" placeholder="Telpon Rumah">
              </div>
              <div class="form-group">
                <label for="nohp">Nomor Handphone</label>
                <input type="text" class="form-control" id="nohp" name="nohp" placeholder="Nomor Handphone">
              </div>
              <div class="form-group">
                <label for="ukuran">Ukuran Pakaian</label>
                <select name="ukuran" id="ukuran" class="form-control">
                  <option disabled="disabled" selected="selected">Pilih</option>
                  <option>S</option>
                  <option>M</option>
                  <option>L</option>
                  <option>XL</option>
                  <option>XXL</option>
                  <option>XXXL</option>
                </select>
              </div>
              <div class="form-group">
                <label for="waris">Nama Ahli Waris</label>
                <input type="text" class="form-control" id="waris" name="waris" placeholder="Nama Ahli Waris">
              </div>
              <div class="form-group">
                <label for="hubungan">Hubungan</label>
                <select name="hubungan" id="hubungan" class="form-control">
                  <option disabled="disabled" selected="selected">Pilih</option>
                  <option>Ayah Kandung</option>
                  <option>Ibu Kandung</option>
                  <option>Suami</option>
                  <option>Istri</option>
                  <option>Saudara</option>
                  <option>Kerabat</option>
                </select>
              </div>
              <div class="form-group">
                <label for="norek">Nomor Rekening</label>
                <input type="text" class="form-control" id="norek" name="norek" placeholder="Nomor Rekening">
              </div>
              <div class="form-group">
                <label for="atas_nama">Atas Nama</label>
                <input type="text" class="form-control" id="atas_nama" name="atas_nama" placeholder="Atas Nama">
              </div>
              <div class="form-group">
                <label for="bank">Nama Bank</label>
                <select name="bank" id="bank" class="form-control">
                  <option disabled="disabled" selected="selected">Pilih Bank</option>
                  <option>Bank Indonesia (BI)</option>
                  <option>Bank Nagari</option>
                  <option>Bank Mandiri</option>
                  <option>Bank Negara Indonesia (BNI)</option>
                  <option>Bank Rakyat Indonesia (BRI)</option>
                  <option>Bank Tabungan Negara (BTN)</option>
                  <option>Bank BRI Agroniaga</option>
                  <option>Bank Central Asia (BCA)</option>
                  <option>Bank CIMB Niaga</option>
                  <option>Bank Danamon Indonesia</option>
                  <option>Bank Maybank Indonesia</option>
                  <option>Bank Mayapada</option>
                  <option>Bank Mega</option>
                  <option>Panin Bank</option>
                  <option>Bank Permata</option>
                  <option>Bank BNI Syariah</option>
                  <option>Bank Mega Syariah</option>
                  <option>Bank Muamalat Indonesia</option>
                  <option>Bank Syariah Mandiri</option>
                  <option>BCA Syariah</option>
                  <option>Bank BJB Syariah</option>
                  <option>Bank BRI Syariah</option>
                  <option>Panin Bank Syariah</option>
                  <option>Bank Syariah Bukopin</option>
                  <option>Bank Victoria Syariah</option>
                  <option>BTPN Syariah</option>
                  <option>Bank Maybank Syariah Indonesia</option>
                  <option>Bank BTN Syariah</option>
                  <option>Bank Danamon Syariah</option>
                  <option>CIMB Niaga Syariah</option>
                  <option>Bank Nagari Syariah</option>
                </select>
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              </div>
              <div class="form-group">
                <div id="msg"></div>
                <input type="file" name="gambar" class="file">
                <div class="input-group my-3">
                  <input type="text" class="form-control" disabled placeholder="Upload Foto" id="file">
                  <div class="input-group-append">
                    <button type="button" id="pilih_gambar" class="browse btn btn-dark">Pilih Foto</button>
                  </div>
                </div>
                <img src="assets/img/upload/80x80.png" id="preview" class="img-thumbnail">
              </div>
            </div>
          </div><br />

          <button type="submit" name="btn_simpan" class="btn btn-primary btn-block">Daftar Sekarang</button><br /><br />
          <p> Sudah Punya Akun? Silahkan <a href="user/login">Login</a> | <a href="index#hero">Kembali Ke Halaman Utama</a></p>
        </form>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-md-6 footer-info">
            <h3>Albadriyah Wisata</h3>
            <p>Al Badar Wisata merupakan perusahaan swasta nasional yang bergerak di bidang Tour dan Travel. Perusahaan ini didirikan pada tahun 1999 dengan nama PT. Al Badriyah Wisata. Dengan Produk Jasa meliputi program Umroh dan Haji Plus. Albadriyah Wisata telah berpengalaman dalam memberangkatkan Umroh dan Haji, serta memiliki izin resmi dari Kemenatrian Agama sebagai penyelenggara Umroh dan Haji.</p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Menu</h4>
            <ul>
              <li><a class="nav-link scrollto active" href="index#hero">Home</a></li>
              <li><a class="nav-link scrollto" href="index#about">Tentang Kami</a></li>
              <!--<li><a class="nav-link scrollto" href="#services">Layanan</a></li>-->
              <li><a class="nav-link scrollto " href="index#portfolio">Info Paket</a></li>
              <li><a class="nav-link scrollto" href="index#contact">Kontak</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Albadriyah Wisata</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
      -->
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<style>
  .file {
    visibility: hidden;
    position: absolute;
  }
</style>

<script>
  function konfirmasi() {
    konfirmasi = confirm("Apakah anda yakin ingin menghapus gambar ini?")
    document.writeln(konfirmasi)
  }

  $(document).on("click", "#pilih_gambar", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
  });

  $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
      // get loaded data and render thumbnail.
      document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
  });

  $(document).ready(function() {
    $("#flash-msg").delay(3000).fadeOut("slow");
  });
</script>
<?php require 'config/auth.php'; ?>


<?php $title = 'Data Jadwal';  ?>

<?php include 'layout/header.php'; ?>

<?php
$data_pendaftaran = select("SELECT * FROM pendaftaran");
?>

<?php include 'layout/sidebar.php'; ?>

<?php
// Cek apakah tombol tambah diklik
if (isset($_POST['btn_simpan'])) {
    if (create_jamaah($_POST) > 0) {
        echo "<script>alert('Selamat! Data Jamaah Berhasil Ditambahkan. Terima Kasih.');window.location='tambah-jamaah'</script>";
    } else {
        echo "<script>alert('Maaf! Data Jamaah Gagal Ditambahkan.');window.location='tambah-jamaah'</script>";
    }
}

?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card shadow p-3 mb-3 mt-3">
                    <h1>Data Jamaah</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item active">Data Jamaah Albadriyah Wisata</li>
                    </ol>
               </div>
               <div class="card mb-4 shadow p-3">
                    <div class="card-body">
                         <?php

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
                         <!-- General Form Elements -->
                         <form action="" method="POST" enctype="multipart/form-data">

                              <div class="row mb-3">
                                   <label for="no_registrasi" class="col-sm-2 col-form-label">Nomor Registrasi</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="no_registrasi" id="no_registrasi" class="form-control"
                                             value="<?php echo $kodereg ?>" readonly>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                                             required>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                             required>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                   <div class="col-sm-10">
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                             required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                   <div class="col-sm-10">
                                        <select name="jk" id="jk" class="form-control">
                                             <option disabled="disabled" selected="selected">Pilih</option>
                                             <option>Pria</option>
                                             <option>Wanita</option>
                                        </select>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="nik" id="nik" class="form-control" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                   <div class="col-sm-10">
                                        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="kota" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kota" name="kota" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                                   <div class="col-sm-10">
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
                              </div>

                              <div class="row mb-3">
                                   <label for="kode_pos" class="col-sm-2 col-form-label">Kode Pos</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="email" class="col-sm-2 col-form-label">Email</label>
                                   <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="telpon_rumah" class="col-sm-2 col-form-label">Telpon Rumah</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="telpon_rumah" name="telpon_rumah"
                                             required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="no_hp" class="col-sm-2 col-form-label">No Handphone</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="ukuran_pakaian" class="col-sm-2 col-form-label">Ukuran Pakaian</label>
                                   <div class="col-sm-10">
                                        <select name="ukuran_pakaian" id="ukuran_pakaian" class="form-control">
                                             <option disabled="disabled" selected="selected">Pilih</option>
                                             <option>S</option>
                                             <option>M</option>
                                             <option>L</option>
                                             <option>XL</option>
                                             <option>XXL</option>
                                             <option>XXXL</option>
                                        </select>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="ahli_waris" class="col-sm-2 col-form-label">Ahli Waris</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ahli_waris" name="ahli_waris"
                                             required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="hubungan" class="col-sm-2 col-form-label">Hubungan</label>
                                   <div class="col-sm-10">
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
                              </div>

                              <div class="row mb-3">
                                   <label for="norekening" class="col-sm-2 col-form-label">No. Rekening</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="norekening" name="norekening"
                                             required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="atas_nama" class="col-sm-2 col-form-label">Atas Nama</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="atas_nama" name="atas_nama"
                                             required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="nama_bank" class="col-sm-2 col-form-label">Nama Bank</label>
                                   <div class="col-sm-10">
                                        <select name="nama_bank" id="nama_bank" class="form-control">
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
                              </div>

                              <div class="row mb-3">
                                   <label for="username" class="col-sm-2 col-form-label">Username</label>
                                   <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" name="username" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="password" class="col-sm-2 col-form-label">Password</label>
                                   <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password"
                                             required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                   <div class="col-sm-10">
                                        <input type="file" name="foto" id="foto" class="form-control" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <div class="col-sm-10">
                                        <button type="submit" name="btn_simpan" id="btn_simpan"
                                             class="btn btn-primary">Tambah Jamaah</button>
                                   </div>
                              </div>

                         </form><!-- End General Form Elements -->
                    </div>
               </div>
               <div class="row p-3">
                    <div class="card mb-4 shadow">
                         <div class="text-center p-3">
                              <h5>Tabel Jadwal Albadriyah Wisata</h5>
                         </div>
                         <div class="card-body">
                              <table id="datatablesSimple" class="table table-hover table-bordered">
                                   <thead class="table-dark">
                                        <tr>
                                             <th class="text-center">No.</th>
                                             <th class="text-center">No. Registrasi</th>
                                             <th class="text-center">Nama Lengkap</th>
                                             <th class="text-center">Tempat Lahir</th>
                                             <th class="text-center">Tanggal Lahir</th>
                                             <th class="text-center">Jenis Kelamin</th>
                                             <th class="text-center">NIK</th>
                                             <th class="text-center">Alamat</th>
                                             <th class="text-center">Foto</th>
                                             <th class="text-center">Aksi</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($data_pendaftaran as $pendaftaran) : ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $pendaftaran['no_registrasi']; ?></td>
                                             <td><?= $pendaftaran['nama_lengkap']; ?></td>
                                             <td><?= $pendaftaran['tempat_lahir']; ?></td>
                                             <td><?= date('d-M-Y', strtotime($pendaftaran['tanggal_lahir'])); ?></td>
                                             <td><?= $pendaftaran['jk']; ?></td>
                                             <td><?= $pendaftaran['nik']; ?></td>
                                             <td><?= $pendaftaran['alamat']; ?></td>
                                             <td><img src="../../assets/img/upload/<?= $pendaftaran['foto'] ?>"
                                                       width="50px"></td>
                                             <td width="15%">
                                                  <a href="ubah-jamaah?id_pend=<?= $pendaftaran['id_pend']; ?>"
                                                       class="btn btn-success">Edit</a>
                                                  <a href="hapus-jamaah?id_pend=<?= $pendaftaran['id_pend']; ?>"
                                                       class="btn btn-danger"
                                                       onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Jamaah?')">Hapus</a>
                                             </td>
                                        </tr>
                                        <?php endforeach; ?>
                                   </tbody>
                              </table>
                         </div>
                    </div>
               </div>


          </div>
     </main>
     <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid px-4">
               <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Albadriyah Wisata 2022</div>
               </div>
          </div>
     </footer>
</div>
</div>

<?php include 'layout/footer.php'; ?>
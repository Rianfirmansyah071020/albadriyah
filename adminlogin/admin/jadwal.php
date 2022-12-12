<?php require 'config/auth.php'; ?>

<?php $title = 'Data Jadwal';  ?>

<?php include 'layout/header.php'; ?>

<?php include 'layout/sidebar.php'; ?>

<?php
// Cek apakah tombol tambah diklik
if (isset($_POST['btn_simpan'])) {
    if (create_jadwal($_POST) > 0) {
        echo "<script>alert('Selamat! Data Jadwal Berhasil Ditambahkan. Terima Kasih.');window.location='jadwal'</script>";
    } else {
        echo "<script>alert('Maaf! Data Jadwal Gagal Ditambahkan.');window.location='jadwal'</script>";
    }
}

?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card shadow mb-3 mt-3 p-3">
                    <h1>Jadwal</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item active">Jadwal Albadriyah Wisata</li>
                    </ol>
               </div>
               <div class="card mb-4 shadow">
                    <div class="card-body">
                         <?php

                    $ambil = mysqli_query($kon, "SELECT max(kode_jadwal) as kodeTerbesar FROM jadwal");
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
                    $huruf = "JDL";
                    $kodereg = $huruf . sprintf("%03s", $urutan);

                    ?>
                         <!-- General Form Elements -->
                         <form action="" method="POST" enctype="multipart/form-data">
                              <div class="row mb-3">
                                   <label for="kode_jadwal" class="col-sm-2 col-form-label">Kode Jadwal</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="kode_jadwal" id="kode_jadwal" class="form-control"
                                             value="<?php echo $kodereg ?>" readonly>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="kode_paket" class="col-sm-2 col-form-label">Kode Paket</label>
                                   <div class="col-sm-10">
                                        <select name="kode_paket" id="kode_paket" class="form-control">
                                             <option disabled="disabled" selected="selected">Pilih</option>
                                             <?php
                                    //query menampilkan data kode paket ke combobox
                                    $query    = mysqli_query($kon, "SELECT * FROM paket GROUP BY id_paket ORDER BY id_paket");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                             <option value="<?= $data['id_paket']; ?>">
                                                  <?php echo $data['kode_paket']; ?></option>
                                             <?php
                                    }
                                    ?>
                                        </select>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="harga" id="harga" class="form-control" required>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="isi_kamar" class="col-sm-2 col-form-label">Isi Kamar</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="isi_kamar" id="isi_kamar" class="form-control"
                                             required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="tanggal_keberangkatan" class="col-sm-2 col-form-label">Tgl.
                                        Keberangkatan</label>
                                   <div class="col-sm-10">
                                        <input type="date" name="tanggal_keberangkatan" id="tanggal_keberangkatan"
                                             class="form-control" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="nopesawat" class="col-sm-2 col-form-label">No. Pesawat</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="nopesawat" id="nopesawat" class="form-control"
                                             required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="tanggal_kepulangan" class="col-sm-2 col-form-label">Tgl.
                                        Kepulangan</label>
                                   <div class="col-sm-10">
                                        <input type="date" name="tanggal_kepulangan" id="tanggal_kepulangan"
                                             class="form-control" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="kuota_pendaftaran" class="col-sm-2 col-form-label">Kuota
                                        Pendaftaran</label>
                                   <div class="col-sm-10">
                                        <input type="number" name="kuota_pendaftaran" id="kuota_pendaftaran"
                                             class="form-control" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <div class="col-sm-10">
                                        <button type="submit" name="btn_simpan" id="btn_simpan"
                                             class="btn btn-primary">Tambah Jadwal</button>
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
                                             <th class="text-center">Kode Jadwal</th>
                                             <th class="text-center">Kode Paket</th>
                                             <th class="text-center" width="15%">Harga</th>
                                             <th class="text-center">Isi Kamar</th>
                                             <th class="text-center">Tanggal Keberangkatan</th>
                                             <th class="text-center">No. Pesawat</th>
                                             <th class="text-center">Tanggal Kepulangan</th>
                                             <th class="text-center">Kuota</th>
                                             <th class="text-center">Aksi</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php $no = 1; ?>
                                        <?php $data_jadwal = mysqli_query($kon, "SELECT * FROM paket INNER JOIN jadwal ON paket.id_paket = jadwal.id_paket");
                                while ($jadwal = mysqli_fetch_array($data_jadwal)) {
                                ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $jadwal['kode_jadwal']; ?></td>
                                             <td><?= $jadwal['kode_paket']; ?></td>
                                             <td>Rp. <?= number_format($jadwal['harga'], 0, ',', '.'); ?></td>
                                             <td><?= $jadwal['isi_kamar']; ?></td>
                                             <td><?= date('d-M-Y', strtotime($jadwal['tanggal_keberangkatan'])); ?></td>
                                             <td><?= $jadwal['nopesawat']; ?></td>
                                             <td><?= date('d-M-Y', strtotime($jadwal['tanggal_kepulangan'])); ?></td>
                                             <td><?= $jadwal['kuota_pendaftaran']; ?></td>
                                             <td width="15%">
                                                  <a href="ubah-jadwal?id_jadwal=<?= $jadwal['id_jadwal']; ?>"
                                                       class="btn btn-success">Edit</a>
                                                  <a href="hapus-jadwal?id_jadwal=<?= $jadwal['id_jadwal']; ?>"
                                                       class="btn btn-danger"
                                                       onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Jadwal?')">Hapus</a>
                                             </td>
                                        </tr>
                                        <?php } ?>
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
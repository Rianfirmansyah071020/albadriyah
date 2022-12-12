<?php require 'config/auth.php'; ?>

<?php $title = 'Data Paket';  ?>

<?php include 'layout/header.php'; ?>

<?php
$data_paket = select("SELECT * FROM paket INNER JOIN jadwal ON paket.id_paket=jadwal.id_paket");
?>

<?php include 'layout/sidebar.php'; ?>

<?php
// Cek apakah tombol tambah diklik
if (isset($_POST['btn_simpan'])) {
    if (create_paket($_POST) > 0) {
        echo "<script>alert('Selamat! Data Paket Berhasil Ditambahkan. Terima Kasih.');window.location='paket'</script>";
    } else {
        echo "<script>alert('Maaf! Data Paket Gagal Ditambahkan. Terima Kasih.');window.location='paket'</script>";
    }
}

?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card shadow p-3 mt-3 mb-3">
                    <h1>Paket</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item active">Paket Albadriyah Wisata</li>
                    </ol>
               </div>
               <div class="card mb-4 shadow">
                    <div class="card-body">
                         <?php

                    $ambil = mysqli_query($kon, "SELECT max(kode_paket) as kodeTerbesar FROM paket");
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
                    $huruf = "PKT";
                    $kodereg = $huruf . sprintf("%03s", $urutan);

                    ?>
                         <!-- General Form Elements -->
                         <form action="" method="POST" enctype="multipart/form-data">
                              <div class="row mb-3">
                                   <label for="kode_paket" class="col-sm-2 col-form-label">Kode Paket</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="kode_paket" id="kode_paket" class="form-control"
                                             value="<?php echo $kodereg ?>" readonly>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="nama_paket" class="col-sm-2 col-form-label">Nama Paket</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="nama_paket" id="nama_paket" class="form-control"
                                             required>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="jenis" class="col-sm-2 col-form-label">Jenis Paket</label>
                                   <div class="col-sm-10">
                                        <select name="jenis" id="jenis" class="form-control" required>
                                             <option value="">Pilih jenis paket</option>
                                             <option value="umroh">Umroh</option>
                                             <option value="haji">Haji</option>
                                        </select>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="pesawat" class="col-sm-2 col-form-label">Pesawat</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="pesawat" id="pesawat" class="form-control" required>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="hotel_mekkah" class="col-sm-2 col-form-label">Hotel Mekkah</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="hotel_mekkah" id="hotel_mekkah" class="form-control"
                                             required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <label for="hotel_madinah" class="col-sm-2 col-form-label">Hotel Madinah</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="hotel_madinah" id="hotel_madinah" class="form-control"
                                             required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <div class="col-sm-10">
                                        <button type="submit" name="btn_simpan" id="btn_simpan"
                                             class="btn btn-primary">Tambah Paket</button>
                                   </div>
                              </div>

                         </form><!-- End General Form Elements -->
                    </div>
               </div>
               <div class="row">
                    <div class="card mb-4">
                         <div class="text-center p-3">
                              <h5>Tabel Paket Albadriyah Wisata</h5>
                         </div>
                         <div class="card-body">
                              <table id="datatablesSimple" class="table table-hover table-bordered">
                                   <thead class="table-dark">
                                        <tr>
                                             <th class="text-center">No.</th>
                                             <th class="text-center">Kode Paket</th>
                                             <th class="text-center">Jenis Paket</th>
                                             <th class="text-center">Nama Paket</th>
                                             <th class="text-center">Pesawat</th>
                                             <th class="text-center">Hotel Mekkah</th>
                                             <th class="text-center">Hotel Madinah</th>
                                             <th class="text-center">Harga</th>
                                             <th class="text-center">Aksi</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($data_paket as $paket) : ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $paket['kode_paket']; ?></td>
                                             <td><?= $paket['jenis']; ?></td>
                                             <td><?= $paket['nama_paket']; ?></td>
                                             <td><?= $paket['pesawat']; ?></td>
                                             <td><?= $paket['hotel_mekkah']; ?></td>
                                             <td><?= $paket['hotel_madinah']; ?></td>
                                             <td><?= number_format($paket['harga']); ?></td>
                                             <td width="15%">
                                                  <a href="ubah-paket?id_paket=<?= $paket['id_paket']; ?>"
                                                       class="btn btn-success">Edit</a>
                                                  <a href="hapus-paket?id_paket=<?= $paket['id_paket']; ?>"
                                                       class="btn btn-danger"
                                                       onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data Paket?')">Hapus</a>
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
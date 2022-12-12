<?php require 'config/auth.php'; ?>

<?php $title = 'Pembayaran';  ?>

<?php include 'layout/header.php'; ?>

<?php
$data_pemesanan  = mysqli_query($kon, "SELECT * FROM pemesanan");
$data_pesan = mysqli_fetch_array($data_pemesanan);

?>

<?php include 'layout/sidebar.php'; ?>

<?php
// Cek apakah tombol tambah diklik
if (isset($_POST['btn_simpan'])) {
    $update_bayar = $_POST['update_bayar'];
    $sisa_bayar = $_POST['sisa_bayar'];
    $kode = $_POST['kode'];
    $kode2 = $_POST['kode2'];


    if (create_pembayaran($_POST) > 0) {
        if ($sisa_bayar == 0) {
            $status1 = 'Lunas';
            // Update Data pesanan lunas
            $queryupdate = "UPDATE pemesanan SET telah_bayar = '$update_bayar', sisa = '$sisa_bayar', status = '$status1' WHERE id_pemesanan = '$kode'";
            mysqli_query($kon, $queryupdate);
            echo "<script>alert('Selamat! Pembayaran Berhasil Ditambahkan. Terima Kasih.');window.location='pembayaran'</script>";
            // Update Data pesanan Belum lunas
        } else {
            $status2 = 'Belum Lunas';
            // Update Data pesanan Belum lunas
            $queryupdate = "UPDATE pemesanan SET telah_bayar = '$update_bayar', sisa = '$sisa_bayar', status = '$status2' WHERE id_pemesanan = '$kode'";
            mysqli_query($kon, $queryupdate);
            echo "<script>alert('Selamat! Pembayaran Berhasil Ditambahkan. Terima Kasih.');window.location='pembayaran'</script>";
        }
    } else {
        echo "<script>alert('Maaf! Pembayaran Gagal Ditambahkan.');window.location='pembayaran'</script>";
    }
}



?>

<div id="layoutSidenav_content">
     <main>
          <div class="container-fluid px-4">
               <div class="card shadow mb-3 mt-3 p-3">
                    <h1>Pembayaran</h1>
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item active">Data Pembayaran Albadriyah Wisata</li>
                    </ol>
               </div>
               <div class="card mb-4 shadow">
                    <div class="card-body">
                         <?php

                    $ambil = mysqli_query($kon, "SELECT max(no_pembayaran) as kodeTerbesar FROM pembayaran");
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
                    $huruf = "PB";
                    $kodereg = $huruf . sprintf("%03s", $urutan);

                    ?>
                         <!-- General Form Elements -->
                         <form action="" method="POST" enctype="multipart/form-data">
                              <div class="row mb-3">
                                   <input type="hidden" name="kode" id="kode" class="form-control">
                                   <input type="hidden" name="kode2" id="kode2" class="form-control">
                                   <input type="hidden" name="kode3" id="kode3" class="form-control">
                                   <input type="text" name="kode4" id="kode4" class="form-control">
                                   <label for="no_pembayaran" class="col-sm-2 col-form-label">No. Pembayaran</label>
                                   <div class="col-sm-10">
                                        <input type="text" name="no_pembayaran" id="no_pembayaran" class="form-control"
                                             value="<?php echo $kodereg ?>" readonly>
                                   </div>
                              </div>
                              <div class="row mb-3">
                                   <label for="no_pemesanan" class="col-sm-2 col-form-label">No. Pemesanan</label>
                                   <div class="col-sm-10">
                                        <select name="no_pemesanan" id="no_pemesanan" class="form-control"
                                             onchange='changeValue(this.value)' required>
                                             <option value="">Pilih</option>
                                             <?php
                                    $query = mysqli_query($kon, "select * from pemesanan order by id_pemesanan asc");
                                    $result = mysqli_query($kon, "select * from pemesanan");
                                    $jsArray = "var prdName = new Array();\n";
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '<option value="' . $row['id_pemesanan'] . '">' . $row['no_pemesanan'] . '</option>';
                                        $jsArray .= "prdName['" . $row['id_pemesanan'] . "'] = {kode:'" . addslashes($row['id_pemesanan']) . "',kode2:'" . addslashes($row['no_pemesanan']) . "',kode3:'" . addslashes($row['id_pend']) . "',kode4:'" . addslashes($row['id_paket']) . "',harganya:'" . addslashes($row['harga']) . "',sudah_bayar:'" . addslashes($row['telah_bayar']) . "'};\n";
                                    }
                                    ?>
                                        </select>
                                   </div>
                              </div>


                              <div class="row mb-3">
                                   <label for="tanggal_bayar" class="col-sm-2 col-form-label">Tanggal Pembayaran</label>
                                   <div class="col-sm-10">
                                        <input type="date" name="tanggal_bayar" id="tanggal_bayar" class="form-control"
                                             required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <input type="hidden" name="harganya" id="harganya" class="form-control"
                                        onkeyup="sum();">
                                   <label for="jumlah_bayar" class="col-sm-2 col-form-label">Jumlah Bayar</label>
                                   <div class="col-sm-10">
                                        <input type="number" name="jumlah_bayar" id="jumlah_bayar" onkeyup="sum();"
                                             class="form-control" required>
                                   </div>
                              </div>
                              <input type="hidden" name="sudah_bayar" id="sudah_bayar" onkeyup="sum();"
                                   class="form-control">
                              <input type="hidden" name="sisa_bayar" id="sisa_bayar" onkeyup="sum();"
                                   class="form-control">
                              <input type="hidden" name="update_bayar" id="update_bayar" onkeyup="sum();"
                                   class="form-control">

                              <script>
                              function sum() {
                                   var txt1 = document.getElementById('jumlah_bayar').value;
                                   var txt2 = document.getElementById('harganya').value;
                                   var txt3 = document.getElementById('sudah_bayar').value;
                                   var result = parseFloat(txt2) - parseFloat(txt1) - parseFloat(txt3);
                                   var bayar = parseFloat(txt1) + parseFloat(txt3);
                                   if (!isNaN(result)) {
                                        document.getElementById('sisa_bayar').value = result;
                                   }

                                   if (!isNaN(bayar)) {
                                        document.getElementById('update_bayar').value = bayar;
                                   }
                              }
                              </script>
                              <div class="row mb-3">
                                   <label for="foto" class="col-sm-2 col-form-label">Bukti Transfer</label>
                                   <div class="col-sm-10">
                                        <input type="file" name="foto" id="foto" class="form-control" required>
                                   </div>
                              </div>

                              <div class="row mb-3">
                                   <div class="col-sm-10">
                                        <button type="submit" name="btn_simpan" id="btn_simpan"
                                             class="btn btn-primary">Tambah Pembayaran</button>
                                   </div>
                              </div>

                         </form><!-- End General Form Elements -->
                    </div>
               </div>
               <div class="row p-3">
                    <div class="card mb-4 shadow">
                         <div class="text-center p-3">
                              <h5>Tabel Pembayaran Albadriyah Wisata</h5>
                         </div>
                         <div class="card-body">
                              <table id="datatablesSimple" class="table table-bordered table-hover">
                                   <thead class="table-dark">
                                        <tr>
                                             <th class="text-center">No.</th>
                                             <th class="text-center">No. Pembayaran</th>
                                             <th class="text-center">No. Pemesanan</th>
                                             <th class="text-center">No. Registrasi</th>
                                             <th class="text-center">Tanggal Bayar</th>
                                             <th class="text-center">Jumlah Bayar</th>
                                             <th class="text-center">Bukti Transfer</th>
                                             <th class="text-center">Status Pembayaran</th>
                                             <th class="text-center">Aksi</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <?php $no = 1; ?>
                                        <?php
                                $data_pembayaran = "SELECT * FROM pembayaran
                                        INNER JOIN pemesanan ON pembayaran.id_pemesanan = pemesanan.id_pemesanan
                                        INNER JOIN pendaftaran ON pembayaran.id_pend = pendaftaran.id_pend
                                        ";
                                $sql_rm = mysqli_query($kon, $data_pembayaran) or die(mysqli_error($kon));
                                while ($pembayaran = mysqli_fetch_array($sql_rm)) {
                                ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $pembayaran['no_pembayaran']; ?></td>
                                             <td><?= $pembayaran['no_pemesanan']; ?></td>
                                             <td><?= $pembayaran['no_registrasi']; ?></td>
                                             <td><?= date('d-M-Y', strtotime($pembayaran['tanggal_bayar'])); ?></td>
                                             <td>Rp. <?= number_format($pembayaran['jumlah_bayar'], 0, ',', '.'); ?>
                                             </td>
                                             <td><img src="../../assets/img/upload/<?= $pembayaran['bukti_transfer'] ?>"
                                                       width="50px"></td>
                                             <td><?= $pembayaran['status_pembayaran']; ?></td>
                                             <td>
                                                  <a href="ubah-pembayaran?id_pembayaran=<?= $pembayaran['id_pembayaran']; ?>"
                                                       class="btn btn-primary"
                                                       onclick="return confirm('Apakah Anda Yakin Untuk Edit Data Pembayaran?')">Edit</a>

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

<script type="text/javascript">
<?php echo $jsArray; ?>

function changeValue(id) {
     document.getElementById('kode').value = prdName[id].kode;
     document.getElementById('kode2').value = prdName[id].kode2;
     document.getElementById('kode3').value = prdName[id].kode3;
     document.getElementById('kode4').value = prdName[id].kode4;
     document.getElementById('harganya').value = prdName[id].harganya;
     document.getElementById('sudah_bayar').value = prdName[id].sudah_bayar;
};
</script>